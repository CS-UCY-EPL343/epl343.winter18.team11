package com.example.myapplication;

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

import java.util.ArrayList;

public class ItemsActivity extends Navigation {

    Toolbar toolbar;
    ListView listView;
    private SqlManager db;
    private String cat;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item);
        /*Set the toolbar*/
        toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        db = new SqlManager(getApplicationContext());
        /*Navigation Settings*/
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        //Get the current category from the intent and put it on the toolbar
        Bundle bundle = getIntent().getExtras();
        listView = (ListView) findViewById(R.id.listView);

        if (bundle != null) {
            cat = bundle.getString("CategoryName");
            //Set the array adapter
            Log.v("Tag cat",cat);
            ArrayList<String> items = new ArrayList<String>();
            items=  db.getItemsFromCategory(cat);
            ArrayAdapter<String> mAdapter = new ArrayAdapter<String>(ItemsActivity.this, android.R.layout.simple_list_item_1, items);
            toolbar.setTitle(getResources().getString(R.string.title_activity_items) +cat );

            listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                @Override
                /*Each category has items */
                public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                    Intent intent = new Intent(ItemsActivity.this, OneItemActivity.class);
                    intent.putExtra("ItemName", listView.getItemAtPosition(position).toString());
                    startActivity(intent);
                }
            });
            listView.setAdapter(mAdapter);
        }
    }
}

