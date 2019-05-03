package com.example.myapplication;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
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
 /**
  *When the basket is created for the user it will
  * select all the data from the orders table and represent it on a table.
  */
public class BasketActivity extends Navigation {

    private ProgressDialog pDialog;
    private SessionManager session;
    ArrayAdapter<String> mAdapter = null;
    private SqlManager db;
    private ListView orderlist ;
    private ArrayList<String> items;
    private HashMap<String,String> orderedItems = new HashMap<String,String>();
    private Button SendOrder;
    private Button removeOrder;

    /**
     * When the user press the back buttton , start the
     * account activity
     */
    @Override
    public void onBackPressed() {
        //Do nothing
    }


    /**
     * On create function of the basket activity
     * When the basket is created for the user it will
     * select all the data from the orders table.
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_basket);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        SendOrder = (Button) findViewById(R.id.btnSendOrder);
        removeOrder = (Button)findViewById(R.id.btnRemoveOrder);
        session = new SessionManager(getApplicationContext());
        db = new SqlManager(getApplicationContext());
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        orderlist = (ListView)  findViewById(R.id.orderlist);

        items = new ArrayList<String>();
        orderedItems =  db.getOrder();

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        ArrayList<Float> prices = new ArrayList<Float>();
        for (Map.Entry<String, String> order_items : orderedItems.entrySet()) {
            String itemName = order_items.getKey();
            String itemValue = order_items.getValue();
            float price = Float.parseFloat(db.getItemPrice(itemName));
            prices.add(price);
            items.add(itemName + " Qty: " + itemValue+ " Price: "+ price+ " €");
        }
            SendOrder.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                    sendOrder();
                }
            });
        removeOrder.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                removeOrder();
            }
        });
        this.mAdapter = new ArrayAdapter<String>(BasketActivity.this, android.R.layout.simple_list_item_1, items);
        orderlist.setAdapter(mAdapter);
        TextView sumText;
        float sum = 0;
        sum = calculateSum(prices);
        sumText = (TextView)findViewById(R.id.sum);
        sumText.setText(Float.toString(sum)+" €");
    }

    public float calculateSum(ArrayList<Float> prices){
        float sum=0;
        for(Float p  : prices){
            sum += p;
        }
        return sum;
    }

    /**
     * Remove the order form the local sqlite database,
     * by collecting each key and value
     */
    public void removeOrder(){
            db.deleteOrder();
         items = new ArrayList<String>();
         orderedItems =  db.getOrder();
        for (Map.Entry<String, String> order_items : orderedItems.entrySet()) {
            String itemName = order_items.getKey();
            String itemValue = order_items.getValue();

            items.add(itemName + " Quantity: " + itemValue);
        }
        this.mAdapter = new ArrayAdapter<String>(BasketActivity.this, android.R.layout.simple_list_item_1, items);
        orderlist.setAdapter(mAdapter);

    }

    /**
     * Send the order to the /orders API endpoint.
     * The end point will search the user with the current
     * email and search the UID and insert the order.
     */
    public void sendOrder() {
        String tag_string_req = "req_update";
        pDialog.setMessage("Sending the order!");
        showDialog();
        Handler handler = new Handler();
        handler.postDelayed(new Runnable() {
            public void run() {
                hideDialog();
            }
        }, 2000);

        StringRequest strReq = new StringRequest(Request.Method.POST,
                NetworkConfigure.URL_ORDER, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    if (!error) {
                        pDialog.setMessage("Your order is stored ! ");
                        showDialog();
                    } else {
                        // Error in login. Get the error message
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(), "Json error: " + e.getMessage(), Toast.LENGTH_LONG).show();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                HashMap<String, String> user = db.getUserDetails();
                orderedItems.put("email",user.get("email"));
                Log.wtf("s",orderedItems.toString());
                return orderedItems;
            }
        };
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
