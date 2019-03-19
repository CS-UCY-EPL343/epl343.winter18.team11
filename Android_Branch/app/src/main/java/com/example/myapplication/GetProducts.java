package com.example.myapplication;

import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class GetProducts extends AppCompatActivity {

    SqlManager db;
    GetProducts(SqlManager db){
        this.db = db;
    }

    /**
     * Fetch the products from the local mysqllite the data.
     *
     */

    public void getProductsSql() {

        Log.wtf("Jason Object","s");
        // Tag used to cancel the request
        String tag_string_req = "products";
        /*SendActivity the request*/
        StringRequest strReq = new StringRequest(Request.Method.POST,
                NetworkConfigure.URL_PRODUCTS, new Response.Listener<String>() {
            /*Capture the request*/
            @Override
            public void onResponse(String response) {
                Log.d("PRO", "Product`s Response: " + response.toString());
                try {
                    JSONObject products = new JSONObject(response);
                    Log.wtf("Jason Object", response.toString());

            /*After fetching from the non local Sql
            add them to the local.*/
                    HashMap<String,String> pair = new HashMap<String,String>();
                    for (int i = 0; i < products.length()-1; i++) {
                        JSONObject obj = new JSONObject();
                        /*  Get the objects as defined from the API
                            products+i from the php file.
                         */
                        obj = products.getJSONObject("products"+String.valueOf(i));
                        String product_name = obj.getString("product_name");
                        String product_price = obj.getString("product_price");
                        String product_category = obj.getString("product_category");
                        String product_desc = obj.getString("product_desc");
                        String product_image= obj.getString("product_image");

                        db.addProduct(product_name, product_price, product_category,product_desc,product_image);
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
        // Adding request to request queue
        StartController.getmInstance().addToRequestQueue(strReq, tag_string_req);
    }



}
