package com.example.myapplication;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

public class CategoryActivity extends AppCompatActivity {

    Toolbar toolbar;
    ListView listView;

    private static String getValue(String tag, Element element) {
        NodeList nodeList = element.getElementsByTagName(tag).item(0).getChildNodes();
        Node node = nodeList.item(0);
        return node.getNodeValue();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item);
        setSupportActionBar(toolbar);
        toolbar = (Toolbar)findViewById(R.id.toolBar);
        toolbar.setTitle(getResources().getString(R.string.shop_name));
        //Find in the listView
        listView = (ListView)findViewById(R.id.listView);
        ArrayAdapter<String> mAdapter = new ArrayAdapter<String>(CategoryActivity.this,android.R.layout.simple_list_item_1,
                getResources().getStringArray(R.array.shop));
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            /*Each category has items */
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(CategoryActivity.this, ItemsActivity.class);
               // getResources().getStringArray(R.array.shop);
                intent.putExtra("ItemName",listView.getItemAtPosition(position).toString());
                startActivity(intent);
            }
        });
        listView.setAdapter(mAdapter);

    }

}
