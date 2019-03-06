package com.example.myapplication;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import java.util.ArrayList;
import java.util.HashMap;

public class SqlManager extends SQLiteOpenHelper {

    private static final String TAG = SQLiteOpenHelper.class.getSimpleName();
    private static final int DATABASE_VERSION = 1;
    private static final String DATABASE_NAME = "android";
    private static final String TABLE_USER = "user";
    private static final String TABLE_ORDER = "orders";
    private static final String TABLE_PRODUCTS = "products";

    /*Keys for Users*/
    private static final String KEY_ID = "id";
    private static final String KEY_NAME = "name";
    private static final String KEY_EMAIL = "email";
    private static final String KEY_MOBILE = "mobile";
    private static final String KEY_ADDRESS = "address";
    private static final String KEY_UID = "uid";
    private static final String KEY_CREATED_AT = "created_at";

    /*Keys for products*/
    private static final String KEY_PRODUCT_ID= "product_id";
    private static final String KEY_PRODUCT_NAME= "product_name";
    private static final String KEY_PRODUCT_CAT= "product_category";
    private static final String KEY_PRODUCT_PRICE= "product_price";
    private static final String KEY_PRODUCT_QUANTITY= "product_quantity";
    private static final String KEY_PRODUCT_DESCRIPTION = "product_description";
    private static final String  KEY_PRODUCT_IMAGE = "product_image";
    public SqlManager(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        String CREATE_LOGIN_TABLE = "CREATE TABLE " + TABLE_USER + "("
                + KEY_ID + " INTEGER PRIMARY KEY," + KEY_NAME + " TEXT,"
                + KEY_EMAIL + " TEXT UNIQUE," + KEY_UID + " TEXT,"
                + KEY_CREATED_AT + " TEXT," + KEY_ADDRESS +" TEXT," + KEY_MOBILE+" TEXT"+")";

        String CREATE_ORDER_TABLE = "CREATE TABLE " +  TABLE_ORDER + "("+ KEY_PRODUCT_ID +
                " TEXT," + KEY_PRODUCT_QUANTITY + " TEXT )";

        String CREATE_PRODUCTS_TABLE = "CREATE TABLE " +  TABLE_PRODUCTS + "("+ KEY_PRODUCT_ID +
                " TEXT," +  KEY_PRODUCT_NAME + " TEXT,"+ KEY_PRODUCT_CAT + " TEXT,"+
                KEY_PRODUCT_PRICE+" TEXT,"+ KEY_PRODUCT_DESCRIPTION + " TEXT," + KEY_PRODUCT_IMAGE + " TEXT"+  " )";

        db.execSQL(CREATE_LOGIN_TABLE);
        db.execSQL(CREATE_ORDER_TABLE);
        db.execSQL(CREATE_PRODUCTS_TABLE);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_USER);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_ORDER);
        /*To DO */
        onCreate(db);
    }
    /*Add the user into local SQL LITE
     */
    public void addUser(String name, String email, String created_at,String address, String mobile) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(KEY_NAME, name);
        values.put(KEY_EMAIL, email);
        values.put(KEY_MOBILE, mobile);
        values.put(KEY_CREATED_AT, created_at);
        values.put(KEY_ADDRESS, address);

        long id = db.insert(TABLE_USER, null, values);
        db.close();
        Log.d(TAG, "New user inserted into sqlite: " + id);
    }

    public void insertOrder(String productId, String productQuantity){

        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(KEY_PRODUCT_ID, productId);
        values.put(KEY_PRODUCT_QUANTITY, productQuantity);

        long id = db.insert(TABLE_ORDER, null, values);
        db.close();
    }


/*
Add product into mysql lite locally
 */
    public void addProduct(String product_name, String product_price,String product_category,String product_desc,String product_image) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();

        values.put(KEY_PRODUCT_NAME, product_name);
        values.put(KEY_PRODUCT_PRICE, product_price);
        values.put(KEY_PRODUCT_CAT, product_category);
        values.put(KEY_PRODUCT_DESCRIPTION, product_desc);
        values.put(KEY_PRODUCT_IMAGE, product_image);

        long id = db.insert(TABLE_PRODUCTS, null, values);
        db.close();
    }
    /*For adding orders*/
    public void addOrder(String product_id , String quantity) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(KEY_PRODUCT_ID, product_id);
        values.put(KEY_PRODUCT_QUANTITY, quantity);
        long id = db.insert(TABLE_ORDER, null, values);
        db.close();
    }
/*Get product details on a hashmap
 */
    public HashMap<String, String> getProductDetails() {
        HashMap<String, String> product = new HashMap<String, String>();
        String selectQuery = "SELECT  * FROM " + TABLE_PRODUCTS;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        cursor.moveToFirst();

        /*To do change cursor*/
        if (cursor.getCount() > 0) {
            product.put("product_id", cursor.getString(1));
            product.put("product_name", cursor.getString(2));
            product.put("product_price", cursor.getString(5));
            product.put("product_category", cursor.getString(6));
        }
        cursor.close();
        db.close();
        Log.d(TAG, "Fetching user from Sqlite: " + product.toString());

        return product;
    }

    public String getItemPrice(String item){
        String selectQuery = "SELECT "+ KEY_PRODUCT_PRICE + " FROM " + TABLE_PRODUCTS + " WHERE " +  KEY_PRODUCT_NAME+ " = "+"'"+ item+"'" ;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        String item_price = "0";
        if(cursor.getCount()>0){
            cursor.moveToNext();
            item_price = cursor.getString(0);
            }
        return item_price;
    }

    public String getItemDesc(String item){
        String selectQuery = "SELECT "+ KEY_PRODUCT_DESCRIPTION + " FROM " + TABLE_PRODUCTS + " WHERE " +  KEY_PRODUCT_NAME+ " = "+"'"+ item+"'" ;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        String item_desc = "0";
        if(cursor.getCount()>0){
            cursor.moveToNext();
            item_desc = cursor.getString(0);
        }
        return item_desc;
    }
    public String getItemImage(String item){
        String selectQuery = "SELECT "+ KEY_PRODUCT_IMAGE + " FROM " + TABLE_PRODUCTS + " WHERE " +  KEY_PRODUCT_NAME + " = "+"'"+ item+"'" ;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        String item_image= "";
        if(cursor.getCount()>0){
            cursor.moveToNext();
            item_image = cursor.getString(0);
        }
        return item_image;
    }


/*Get the current categories from the local database
* */
        public ArrayList<String> getCategories() {
            ArrayList<String> categories = new ArrayList<String>();
            String selectQuery = "SELECT " + KEY_PRODUCT_CAT + " FROM " + TABLE_PRODUCTS;
            SQLiteDatabase db = this.getReadableDatabase();
            Cursor cursor = db.rawQuery(selectQuery, null);
            if (cursor.getCount() > 0) {
                while (cursor.moveToNext()) {
                    categories.add(cursor.getString(0));
                }
            }
            return categories;
        }

    public HashMap<String, String>  getOrder(){
        SQLiteDatabase db = this.getWritableDatabase();
        HashMap<String,String>  products = new HashMap<String,String> ();
        String selectQuery = "SELECT  * FROM " + TABLE_ORDER;
        Cursor cursor = db.rawQuery(selectQuery, null);

        if(cursor.getCount()>0){
            while(cursor.moveToNext()) {
                products.put(cursor.getString(0),cursor.getString(1));
            }
        }
        db.close();
        cursor.close();
        return products ;
    }

    public ArrayList<String> getItemsFromCategory(String Cat){

        ArrayList<String> items = new ArrayList<String>();
        String selectQuery = "SELECT "+KEY_PRODUCT_NAME + " FROM " + TABLE_PRODUCTS + " WHERE " + KEY_PRODUCT_CAT +" = "+"'"+ Cat+"'" ;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);

        if(cursor.getCount()>0){
            while(cursor.moveToNext()) {
                items.add(cursor.getString(0));
            }
        }
        db.close();
        return items;
    }

/*Get user details on a hashmap*
 */
    public HashMap<String, String> getUserDetails() {
        HashMap<String, String> user = new HashMap<String, String>();
        String selectQuery = "SELECT  * FROM " + TABLE_USER;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        cursor.moveToFirst();
        if (cursor.getCount() > 0) {
            user.put("name", cursor.getString(1));
            user.put("email", cursor.getString(2));
            user.put("address", cursor.getString(5));
            user.put("mobile", cursor.getString(6));
        }
        cursor.close();
        db.close();
        Log.d(TAG, "Fetching user from Sqlite: " + user.toString());

        return user;
    }

    public void deleteTables() {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete(TABLE_USER, null, null);
        db.delete(TABLE_ORDER, null, null);
        db.delete(TABLE_PRODUCTS, null, null);
        db.close();
        Log.d(TAG, "Deleted all user info from sqlite");
    }

}