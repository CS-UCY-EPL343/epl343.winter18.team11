
package com.example.myapplication;
import android.content.Context;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.util.Log;

/** Class responsible for manager session and other information found as properties of this class.
 *
 */
public class SessionManager {
    private static String TAG = SessionManager.class.getSimpleName();
    SharedPreferences pref;
    Editor editor;
    Context _context;
    private static final String PREF_NAME = "AndroidHiveLogin";
    private static final String KEY_IS_LOGGEDIN = "isLoggedIn";
    private static final String KEY_ARE_PRODUCTS= "areProducts";

    public SessionManager(Context context) {
        /*Always for getting a setting a preference we must call the editor access class*/
        this._context = context;
        pref = _context.getSharedPreferences(PREF_NAME, 0);
        editor = pref.edit();
    }
    public void setLogin(boolean isLoggedIn) {
        CategoryActivity cat = new CategoryActivity();
        /*Insert into the preferences that the user is logged in */
        editor.putBoolean(KEY_IS_LOGGEDIN, isLoggedIn);
        editor.commit();
        Log.d(TAG, "User Login Modifieded");

    }

    public void setProduct(boolean areProductsShown) {
        /*Insert into the preferences that products are shown*/
        editor.putBoolean(KEY_ARE_PRODUCTS, areProductsShown);
        editor.commit();
        Log.d(TAG, "Products are shown");
    }

    public boolean areProducts(){
        return pref.getBoolean(KEY_ARE_PRODUCTS, false);
    }

    public boolean isLoggedIn(){
        return pref.getBoolean(KEY_IS_LOGGEDIN, false);
    }
}