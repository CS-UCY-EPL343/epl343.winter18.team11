package com.example.myapplication;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapShader;
import android.graphics.Canvas;
import android.graphics.Paint;
import android.graphics.RectF;
import android.graphics.Shader;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.squareup.picasso.Transformation;

import java.util.ArrayList;

public class ItemsActivity extends Navigation {
    private Toolbar toolbar;
    private ListView listView;
    private SqlManager db;
    private String cat;
    private ArrayAdapter<String> mAdapter = null;
    private SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item);
        /*Set the toolbar*/
        toolbar = (Toolbar) findViewById(R.id.toolbar);
        Bundle bundle = getIntent().getExtras();

        if (bundle != null) {
            cat = bundle.getString("CategoryName");
            String TitleToobar = getResources().getString(R.string.title_activity_items)+ " " +cat;
            toolbar.setTitle(TitleToobar);
            session = new SessionManager(getApplicationContext());
            db = new SqlManager(getApplicationContext());

        /*Navigation Settings*/
            DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
            ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
            setSupportActionBar(toolbar);
            drawer.addDrawerListener(toggle);
            toggle.syncState();
            NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
            navigationView.setNavigationItemSelectedListener(this);

        //Get the current category from the intent and put it on the toolbar
            listView = (ListView)findViewById(R.id.listViewScroll);
                //Set the array adapter
            ArrayList<String> items = new ArrayList<String>();
            items=  db.getItemsFromCategory(cat);
            this.mAdapter = new ArrayAdapter<String>(ItemsActivity.this, android.R.layout.simple_list_item_1, items);
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

    public class CircleTransform implements Transformation {
        private final int radius;
        private final int margin; // dp

        // radius is corner radii in dp
        // margin is the board in dp
        public CircleTransform(final int radius, final int margin) {
            this.radius = radius;
            this.margin = margin;
        }

        @Override
        public Bitmap transform(final Bitmap source) {
            final Paint paint = new Paint();
            paint.setAntiAlias(true);
            paint.setShader(new BitmapShader(source, Shader.TileMode.CLAMP,
                    Shader.TileMode.CLAMP));

            Bitmap output = Bitmap.createBitmap(source.getWidth(),
                    source.getHeight(), Bitmap.Config.ARGB_8888);
            Canvas canvas = new Canvas(output);
            canvas.drawRoundRect(new RectF(margin, margin, source.getWidth()
                    - margin, source.getHeight() - margin), radius, radius, paint);
            if (source != output) {
                source.recycle();
            }
            return output;
        }

        @Override
        public String key() {
            return "rounded";
        }
    }

}

