package com.example.myapplication;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;


public class OneItemActivity extends AppCompatActivity {


    Toolbar mToolbar;
    ImageView flag;
    TextView priceText;
    Button addToCard;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_one_item);

        mToolbar = (Toolbar)findViewById(R.id.toolBar1);
        flag =(ImageView)findViewById(R.id.imageView);
        priceText = (TextView) findViewById(R.id.priceList);
        addToCard = (Button)findViewById(R.id.addtocardlist);
        //Get the name from the intent and put it on the toolbar
        Bundle bundle = getIntent().getExtras();
        if(bundle!=null){
            mToolbar.setTitle(bundle.getString("ItemName"));
            if(mToolbar.getTitle().toString().equalsIgnoreCase("Ekklisiastika")){
                flag.setImageDrawable(ContextCompat.getDrawable(OneItemActivity.this,R.drawable.ekklisiastika));
                priceText.setText("Price: $10");
            }
        }


    }
}
