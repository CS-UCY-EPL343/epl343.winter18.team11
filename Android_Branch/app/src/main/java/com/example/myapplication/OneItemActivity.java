package com.example.myapplication;

import android.os.Bundle;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;


public class OneItemActivity extends AppCompatActivity {

    TextView titleList;
    Toolbar mToolbar;
    ImageView flag;
    TextView priceText;
    Button addToCard;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_one_item);
        titleList = (TextView)findViewById(R.id.titlelist);
        mToolbar = (Toolbar)findViewById(R.id.toolBar1);
        flag =(ImageView)findViewById(R.id.productlist);
        priceText = (TextView) findViewById(R.id.priceList);
        addToCard = (Button)findViewById(R.id.addtocardlist);
        //Get the name from the intent and put it on the toolbar
        Bundle bundle = getIntent().getExtras();
        if(bundle!=null){
            mToolbar.setTitle(bundle.getString("ItemName"));

           /*This must be automated*/
            if(mToolbar.getTitle().toString().equalsIgnoreCase("Ekklisiastika")){
                flag.setImageDrawable(ContextCompat.getDrawable(OneItemActivity.this,R.drawable.ekklisiastika));
                priceText.setText("Price: $10");
                titleList.setText("Αγιον Δισκοποτηρον");
            }
        }


    }
}
