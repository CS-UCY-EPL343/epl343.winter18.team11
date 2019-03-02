package com.example.myapplication;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import java.util.ArrayList;

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
        listView = (ListView)findViewById(R.id.listViewScroll);

        /*This mAdapter must have a different structure
        * 1. On creation of this instance we must update the local database of Android
        *
        * */
        ArrayList<String> categories = new ArrayList<String>();

        categories = db.getCategories();

        this.mAdapter = new ArrayAdapter<String>(CategoryActivity.this,android.R.layout.simple_list_item_1,
                categories);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            /*Each category has items */
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(CategoryActivity.this, ItemsActivity.class);
                intent.putExtra("CategoryName",listView.getItemAtPosition(position).toString());
                startActivity(intent);
            }
        });
        listView.setAdapter(mAdapter);
    }

}
