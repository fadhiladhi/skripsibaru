package com.viss.pemesanan.Fragment;

import android.app.ProgressDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.request.JsonObjectRequest;
import com.viss.pemesanan.Adapter.PemesananAdapter;
import com.viss.pemesanan.Adapter.PengirimanAdapter;
import com.viss.pemesanan.Model.Pemesanan;
import com.viss.pemesanan.Model.PengirimanModel;
import com.viss.pemesanan.Model.UserModel;
import com.viss.pemesanan.MySingleton;
import com.viss.pemesanan.R;
import com.viss.pemesanan.SessionHandler;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class PemesananFragment extends Fragment {
    private ProgressDialog pDialog;
    RecyclerView lv;
    UserModel user;
    PemesananAdapter pemesananAdapter;
    ArrayList<Pemesanan> pemesananList;
    public static final String url = "http://347f969e2cb4.ngrok.io/db_pemesanan/get_daftar_pemesanan.php";
    Button pesan_wa;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View v =  inflater.inflate(R.layout.fragment_pemesanan, container, false);
        lv = v.findViewById(R.id.rv_pemesanan);
        pesan_wa = v.findViewById(R.id.pesan_wa);
        pesan_wa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                pesanwa();
            }
        });
        SessionHandler session = new SessionHandler(getActivity());
        user = session.getUserDetails();
        GridLayoutManager gridLayoutManager = new GridLayoutManager(getActivity(),1,GridLayoutManager.VERTICAL, false);
        lv.setLayoutManager(gridLayoutManager);
        pemesananList = new ArrayList<>();
        pemesananAdapter = new PemesananAdapter(getActivity(), pemesananList);
        lv.setAdapter(pemesananAdapter);
        getPemesanan();
        return v;
    }

    private void pesanwa() {
        String url = "https://api.whatsapp.com/send?phone=+6281310590699&text=Assalamaualaikum,...%0aUsername : "+user.getUsername()+"%0aingin membeli ikan anda dengan data berikut: %0a%0aNama :  %0aalamat : %0aNo Telpon : %0a%0aUntuk Pembayaran saya akan transfer ke BANK BCA : %0aNo Rek : 123456 %0aA/N : Ahmad Fadhil %0a%0aSaya akan transfer dan mengirim foto bukti pembayaran sesuai jumlah di alamat website dengan note : nama username saya";
        Intent sendmsg = new Intent(Intent.ACTION_VIEW);
        sendmsg.setPackage("com.whatsapp");
        sendmsg.setData(Uri.parse(url));
        startActivity(sendmsg);
    }

    private void displayLoader() {
        pDialog = new ProgressDialog(getActivity());
        pDialog.setMessage("Sedang diproses...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();
    }
    private void getPemesanan() {
        displayLoader();
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url, null, response -> {
                    pDialog.dismiss();
                    try {
                        if (response.getInt("status") == 0) {
                            JSONArray jsonArray = response.getJSONArray("pemesanan");
                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject jsonObject = jsonArray.getJSONObject(i);
                                Pemesanan pemesanan = new Pemesanan();
                                if(user.getUsername().equals(jsonObject.getString("namapemesanan"))){
                                    pemesanan.setId(jsonObject.getString("id"));
                                    pemesanan.setNamaikan(jsonObject.getString("namaikan"));
                                    pemesanan.setJenisikan(jsonObject.getString("jenisikan"));
                                    pemesanan.setHarga(jsonObject.getString("harga"));
                                    pemesanan.setDeskripsi(jsonObject.getString("deskripsi"));
                                    pemesanan.setImg_url(jsonObject.getString("img_url"));
                                    pemesananList.add(pemesanan);
                                }


                            }
                            pemesananAdapter.notifyDataSetChanged();


                        } else {
                            Toast.makeText(getActivity(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, error -> {
                    pDialog.dismiss();
                    Toast.makeText(getActivity(),
                            error.getMessage(), Toast.LENGTH_SHORT).show();
                });

        MySingleton.getInstance(getActivity()).addToRequestQueue(jsArrayRequest);
    }
}