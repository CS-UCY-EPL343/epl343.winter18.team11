package com.example.myapplication;

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

public class ItemsActivity extends Navigation {

    Toolbar toolbar;
    ListView listView;
    private SqlManager db;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item);

        toolbar = (Toolbar) findViewById(R.id.toolbar);


        db = new SqlManager(getApplicationContext());
        /*Navigation Settings*/

        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        //Get the current category from the intent and put it on the toolbar
        Bundle bundle = getIntent().getExtras();
        String items[] = new String[20];
        listView = (ListView) findViewById(R.id.listView);

        if (bundle != null) {
            switch (bundle.getString("CategoryName")) {
                case "Ekklisiastika":
                    items = getResources().getStringArray(R.array.Ekklisiastika);
                    toolbar.setTitle("Ekklisiastika");
            }
            //Set the array adapter
            ArrayAdapter<String> mAdapter = new ArrayAdapter<String>(ItemsActivity.this, android.R.layout.simple_list_item_1, items);

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
