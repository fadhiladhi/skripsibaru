package com.viss.pemesanan;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.request.JsonObjectRequest;
import com.bumptech.glide.Glide;
import com.viss.pemesanan.Model.UserModel;

import org.json.JSONException;
import org.json.JSONObject;

public class AccpetPengirimanActivity extends AppCompatActivity {
    private ProgressDialog pDialog;
    String id_pengiriman, selesai1 = "selesai";
    UserModel user;
    public static final String url = "http://347f969e2cb4.ngrok.io/db_pemesanan/get_pengiriman.php";
    public static final String url_selesai = "http://347f969e2cb4.ngrok.io/db_pemesanan/tambah_selesai.php";
    TextView tglpemesanan, jasapengiriman, namaikan, status, noresi;
    Button selesai;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_accpet_pengiriman);
        getSupportActionBar().hide();
        Bundle extras = getIntent().getExtras();
        SessionHandler session = new SessionHandler(this);
        user = session.getUserDetails();
        if (extras != null) {
            id_pengiriman = extras.getString("id");
        }
        tglpemesanan = findViewById(R.id.accept_tglpemesanan);
        jasapengiriman = findViewById(R.id.accept_jasapengiriman);
        status = findViewById(R.id.accept_status);
        noresi = findViewById(R.id.accept_noresi);
        selesai = findViewById(R.id.btn_accept_penjualan);
        selesai.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (status.getText().toString().equals("pengiriman")) {
                    setSelesai();
                }else{
                    status.setError("Error");
                    status.requestFocus();
                }

            }
        });
        getCupang();

    }

    private void setSelesai() {
        displayLoader();
        JSONObject request = new JSONObject();
        try {
            request.put("status", selesai1);
            request.put("id", id_pengiriman);
            request.put("tglpengiriman", tglpemesanan.getText().toString());
            request.put("jasapengiriman", jasapengiriman.getText().toString());
            request.put("noresi", noresi.getText().toString());
        } catch (JSONException e) {
            e.printStackTrace();
        }
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url_selesai, request, response -> {
                    pDialog.dismiss();
                    try {
                        if (response.getInt("status") == 0) {
                            Toast.makeText(getApplicationContext(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();
                            onBackPressed();
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

    private void displayLoader() {
        pDialog = new ProgressDialog(AccpetPengirimanActivity.this);
        pDialog.setMessage("Sedang diproses...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();
    }
    private void getCupang() {
        displayLoader();
        JSONObject request = new JSONObject();
        try {
            request.put("id", id_pengiriman);
        } catch (JSONException e) {
            e.printStackTrace();
        }
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url, request, response -> {
                    pDialog.dismiss();
                    try {
                        if (response.getInt("status1") == 0) {
                            tglpemesanan.setText(response.getString("tglpemesanan"));
                            jasapengiriman.setText(response.getString("jasapengiriman"));
                            status.setText(response.getString("status"));
                            noresi.setText(response.getString("noresi"));


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

    @Override
    public void onBackPressed() {
        super.onBackPressed();
    }
}