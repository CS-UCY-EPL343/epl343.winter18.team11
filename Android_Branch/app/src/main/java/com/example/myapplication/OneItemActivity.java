package com.example.myapplication;

import android.app.Activity;
import android.os.Bundle;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.widget.Toolbar;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

public class OneItemActivity extends Activity {

    /*Each Item must be stored inside an xml file and
    be retrieved each time.
     */
    TextView descriptionText;
    TextView titleList;
    Toolbar toolbar;
    ImageView imageProduct ;
    TextView priceText;
    Button addToCard;
    private String item;
    private SqlManager db;

    /*Product Strings*/
    String price;
    String image_product;
    String description;

    /*On back pressed */
    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_one_item);
        titleList = (TextView)findViewById(R.id.titlelist);
        toolbar = (Toolbar)findViewById(R.id.toolbar);
        imageProduct =(ImageView)findViewById(R.id.productImg);
        priceText = (TextView) findViewById(R.id.priceList);
        descriptionText= (TextView) findViewById(R.id.descriptionText);
        addToCard = (Button)findViewById(R.id.addtocardlist);

        /*
         * Drawer Layout
         * */
        toolbar = (Toolbar)findViewById(R.id.toolbar);




        //Get the name from the intent and put it on the toolbar
        Bundle bundle = getIntent().getExtras();
        db = new SqlManager(getApplicationContext());

        /*Navigation Settings*/

        if (bundle != null) {

            item = bundle.getString("ItemName");
            toolbar.setTitle(item);
            setSupportActionBar(toolbar);
            db = new SqlManager(getApplicationContext());
            price = db.getItemPrice(item);
            description = db.getItemDesc(item);
            image_product= db.getItemImage(item);
            StringBuilder priceS= new StringBuilder();
            priceS.append(price+ " €");
            priceText.setText(price);
            StringBuilder descS= new StringBuilder();
            descS.append("Description\n\n"+ description);
            descriptionText.setText(descS);
            Picasso.with(getApplicationContext()).load("http://i.imgur.com/DvpvklR.png").into(imageProduct);

        }
        }

    private void setSupportActionBar(Toolbar toolbar) {
    }
}

