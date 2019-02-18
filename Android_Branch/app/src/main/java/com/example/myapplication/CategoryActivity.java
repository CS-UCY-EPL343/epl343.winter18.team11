package com.example.myapplication;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class CategoryActivity extends Navigation {
    private ProgressDialog pDialog;
    private SessionManager session;
     ArrayAdapter<String> mAdapter = null;

    Toolbar toolbar;
    ListView listView;
    private SqlManager db;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item);

        /*Toolbar*/
        toolbar = (Toolbar)findViewById(R.id.toolbar);
        toolbar.setTitle(getResources().getString(R.string.shop_name));
        setSupportActionBar(toolbar);
/*
        Get the
         a. session
         b. database
         c. pDialog
*/
        session = new SessionManager(getApplicationContext());
        db = new SqlManager(getApplicationContext());
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        /*
        * Drawer Layout
        * */
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);


        /*Find in the listView and view all the items in the string*/
        listView = (ListView)findViewById(R.id.listView);

        /*This mAdapter must have a different structure
        * 1. On creation of this instance we must update the local database of Android
        *
        * */
        getProductsSql(mAdapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            /*Each category has items */
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(CategoryActivity.this, ItemsActivity.class);
                intent.putExtra("CategoryName",listView.getItemAtPosition(position).toString());
                startActivity(intent);
            }
        });
        listView.setAdapter(null);
        listView.setAdapter(mAdapter);
    }
    /**
     * Fetch the products from the local sql th
     * @param mAdapter : The local mAdapter to bridge the view with
     *                 the data.
     *
     */
    private void getProductsSql(ArrayAdapter<String> mAdapter) {
        Log.wtf("Jason Object","s");
        // Tag used to cancel the request
        String tag_string_req = "products";
        pDialog.setMessage("Fetching Products");
        showDialog();
        /*Send the request*/
        StringRequest strReq = new StringRequest(Request.Method.POST,
                NetworkConfigure.URL_PRODUCTS, new Response.Listener<String>() {
            /*Capture the request*/
           @Override
            public void onResponse(String response) {
                Log.d("PRO", "Product`s Response: " + response.toString());
                hideDialog();
                try {
                    JSONObject products = new JSONObject(response);
                    Log.wtf("Jason Object", response.toString());

            /*After fetching from the non local Sql
            add them to the local.
            * */    session.setProduct(true);
                    HashMap<String,String> pair = new HashMap<String,String>();
                    for (int i = 0; i < products.length(); i++) {
                        JSONObject obj = new JSONObject();
                        /*  Get the objects as defined from the API
                            products+i from the php file.
                         */
                        obj = products.getJSONObject("products"+String.valueOf(i));
                        String product_name = obj.getString("product_name");
                        String product_price = obj.getString("product_price");
                        String product_category = obj.getString("product_category");

                        db.addProduct(product_name, product_price, product_category);
                    }
                } catch (JSONException e1) {
                    e1.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("PRO", "Login Error: " + error.getMessage());
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to products url
                Map<String, String> params = new HashMap<String, String>();

                params.put("products","xml");

                return params;
            }

        };
        /*Create a HashMap that will get the categories
         */
        ArrayList<String> categories = new ArrayList<String>();
                categories = db.getCategories();
        this.mAdapter = new ArrayAdapter<String>(CategoryActivity.this,android.R.layout.simple_list_item_1,
                categories);
        // Adding request to request queue
        StartController.getmInstance().addToRequestQueue(strReq, tag_string_req);
    }

    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }

}
