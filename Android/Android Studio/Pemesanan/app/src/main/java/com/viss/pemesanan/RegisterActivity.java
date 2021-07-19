package com.viss.pemesanan;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.request.JsonObjectRequest;

import org.json.JSONException;
import org.json.JSONObject;

public class RegisterActivity extends AppCompatActivity {
    EditText nama, username, password, passwordConfirm;
    private ProgressDialog pDialog;
    Button btn_regis;
    public static final String url = "http://347f969e2cb4.ngrok.io/db_pemesanan/daftar.php";
    String Snama, Susername, Spassword, SpasswordConfirm;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        nama = findViewById(R.id.et_name);
        username = findViewById(R.id.et_username);
        password = findViewById(R.id.et_password);
        passwordConfirm = findViewById(R.id.et_passwordconfirm);
        btn_regis = findViewById(R.id.btn_regis);

        btn_regis.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Snama = nama.getText().toString().trim();
                Susername = username.getText().toString().trim();
                Spassword = password.getText().toString().trim();
                SpasswordConfirm = passwordConfirm.getText().toString().trim();

                if(validateInputs()){
                    daftar();
                }
            }
        });

    }
    private boolean validateInputs() {
        if (Snama.equals("")) {
            nama.setError("Nama Lengkap tidak boleh kosong");
            nama.requestFocus();
            return false;
        }
        if (Susername.equals("")) {
            username.setError("Username tidak boleh kosong");
            username.requestFocus();
            return false;
        }
        if (SpasswordConfirm.equals("")) {
            passwordConfirm.setError("Password tidak boleh kosong");
            passwordConfirm.requestFocus();
            return false;
        }
        if (Spassword.equals("")) {
            password.setError("Password tidak boleh kosong");
            password.requestFocus();
            return false;
        }

        return true;
    }
    private void displayLoader() {
        pDialog = new ProgressDialog(RegisterActivity.this);
        pDialog.setMessage("Sedang diproses...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();
    }

    private void daftar() {
        displayLoader();
        JSONObject request = new JSONObject();
        try {
            request.put("nama", Snama);
            request.put("username", Susername);
            request.put("password", Spassword);
        } catch (JSONException e) {
            e.printStackTrace();
        }
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url, request, response -> {
                    pDialog.dismiss();
                    try {
                        if (response.getInt("status") == 0) {
                            Toast.makeText(getApplicationContext(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();
                            Intent i = new Intent(getApplicationContext(), MainActivity.class);
                            startActivity(i);
                            finish();
                        } else {
                            Toast.makeText(getApplicationContext(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, error -> {
                    pDialog.dismiss();
                    Toast.makeText(getApplicationContext(),
                            error.getMessage(), Toast.LENGTH_SHORT).show();
                });

        MySingleton.getInstance(this).addToRequestQueue(jsArrayRequest);
    }
}