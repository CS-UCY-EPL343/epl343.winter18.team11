package com.example.myapplication;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class OneItemActivity extends AppCompatActivity {

    /*Each Item must be stored inside an xml file and
    be retrieved each time.
     */
    TextView descriptionText;
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
        descriptionText= (TextView) findViewById(R.id.descriptionText);
        addToCard = (Button)findViewById(R.id.addtocardlist);

        //Get the name from the intent and put it on the toolbar
        Bundle bundle = getIntent().getExtras();
        int resourceIDStringArray = getResources().getIdentifier(
                bundle.getString("ItemName").replaceAll("\\s",""),
                "array",
                getPackageName()
        );

        String attributes[] = new String[20];
//        Log.v("Tag 3" ,  bundle.getString("ItemName"));
        attributes = getResources().getStringArray(resourceIDStringArray);
        if(bundle!=null){
          // mToolbar.setTitle( bundle.getString(""));
           /*This must be automated*/
            String imageStr = attributes[2];
            int resourceIDImage = getResources().getIdentifier(
                   imageStr,
                   "drawable",
                   getPackageName()
           );
            flag.setImageDrawable(OneItemActivity.this.getResources().getDrawable(resourceIDImage));
            titleList.setText( bundle.getString("ItemName"));
            descriptionText.setText(attributes[0]);
            priceText.setText(attributes[1]);

            }
        }
    }

