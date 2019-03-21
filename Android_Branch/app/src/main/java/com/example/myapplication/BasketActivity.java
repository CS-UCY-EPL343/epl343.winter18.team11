package com.example.myapplication;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
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
    @Override
    public void onBackPressed() {
        Intent intent = new Intent(BasketActivity.this, AccountActivity.class);
        startActivity(intent);
        finish();
    }

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
        for (Map.Entry<String, String> order_items : orderedItems.entrySet()) {
            String itemName = order_items.getKey();
            String itemValue = order_items.getValue();

            items.add(itemName + " Quantity: " + itemValue);
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
    }

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
