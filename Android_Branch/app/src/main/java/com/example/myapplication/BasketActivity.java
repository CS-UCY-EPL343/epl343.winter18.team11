package com.example.myapplication;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class BasketActivity extends Navigation {

    private ProgressDialog pDialog;
    private SessionManager session;
    ArrayAdapter<String> mAdapter = null;
    private SqlManager db;
    private ListView orderlist ;


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

        session = new SessionManager(getApplicationContext());
        db = new SqlManager(getApplicationContext());
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        orderlist = (ListView)  findViewById(R.id.orderlist);

        HashMap<String,String> orderedItems = new HashMap<String,String>();
        ArrayList<String> items = new ArrayList<String>();
        orderedItems =  db.getOrder();

        for(Map.Entry<String, String>  order_items : orderedItems.entrySet()){
                String itemName = order_items.getKey();
                String itemValue = order_items.getValue();
                items.add(itemName+" Quantity: "+itemValue);
        }

        this.mAdapter = new ArrayAdapter<String>(BasketActivity.this, android.R.layout.simple_list_item_1, items);
        orderlist.setAdapter(mAdapter);
    }

}
