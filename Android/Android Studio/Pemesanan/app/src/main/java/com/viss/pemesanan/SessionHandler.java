package com.viss.pemesanan;

import android.content.Context;
import android.content.SharedPreferences;

import com.viss.pemesanan.Model.UserModel;

public class SessionHandler {
    private static final String PREF_NAME = "UserSession";
    private static final String KEY_ID = "id";
    private static final String KEY_NAMA = "name";
    private static final String KEY_USERNAME = "username";
    private static final String KEY_ROLE = "role";
    private static final String KEY_EMPTY = "";
    private Context mContext;
    private SharedPreferences.Editor mEditor;
    private SharedPreferences mPreferences;

    public SessionHandler(Context mContext) {
        this.mContext = mContext;
        mPreferences = mContext.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        this.mEditor = mPreferences.edit();
    }

    public void loginUser(String id, String nama, String role,String username) {
        mEditor.putString(KEY_ID, id);
        mEditor.putString(KEY_NAMA, nama);
        mEditor.putString(KEY_ROLE, role);
        mEditor.putString(KEY_USERNAME, username);
        mEditor.commit();
    }

    public UserModel getUserDetails() {
        UserModel user = new UserModel();
        user.setId(mPreferences.getString(KEY_ID, KEY_EMPTY));
        user.setNama(mPreferences.getString(KEY_NAMA, KEY_EMPTY));
        user.setRole(mPreferences.getString(KEY_ROLE, KEY_EMPTY));
        user.setUsername(mPreferences.getString(KEY_USERNAME, KEY_EMPTY));
        return user;
    }

    public void logoutUser(){
        mEditor.clear();
        mEditor.commit();
    }

}
