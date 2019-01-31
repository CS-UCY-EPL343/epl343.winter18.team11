package com.example.myapplication;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

public class ItemActivity extends AppCompatActivity {

    Toolbar toolbar;
    ListView listView;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item);
        setSupportActionBar(toolbar);
        toolbar = (Toolbar)findViewById(R.id.toolBar);
        toolbar.setTitle(getResources().getString(R.string.shop_name));
        //Find in the listView
        listView = (ListView)findViewById(R.id.listView);
        ArrayAdapter<String> mAdapter = new ArrayAdapter<String>(ItemActivity.this,android.R.layout.simple_list_item_1,
                getResources().getStringArray(R.array.shop));
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            /*Pass to another Activity the name */
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(ItemActivity.this, OneItemActivity.class);
                intent.putExtra("ItemName",listView.getItemAtPosition(position).toString());
                startActivity(intent);
            }
        });
        listView.setAdapter(mAdapter);

    }

}
