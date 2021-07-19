package com.viss.pemesanan.Adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.viss.pemesanan.AccpetPengirimanActivity;
import com.viss.pemesanan.Model.Pemesanan;
import com.viss.pemesanan.Model.PengirimanModel;
import com.viss.pemesanan.R;

import java.util.ArrayList;

public class PemesananAdapter extends RecyclerView.Adapter<PemesananAdapter.MyViewHolder> {

    Context context;
    ArrayList<Pemesanan> list;

    public PemesananAdapter(Context context, ArrayList<Pemesanan> list) {
        this.context = context;
        this.list = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View v = LayoutInflater.from(context).inflate(R.layout.view_pemesanan, parent, false);
        return new MyViewHolder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Pemesanan pemesanan = list.get(position);
        holder.namaikan.setText(pemesanan.getNamaikan());
        holder.jenisikan.setText(pemesanan.getJenisikan());
        holder.harga.setText(pemesanan.getHarga());
        holder.deskripsi.setText(pemesanan.getDeskripsi());
        String url = "http://347f969e2cb4.ngrok.io/pemesanan/uploads/"+pemesanan.getImg_url();
        Glide.with(context).load(url).apply(new RequestOptions().placeholder(R.drawable.ic_launcher_background).dontAnimate()).into(holder.img);



    }

    @Override
    public int getItemCount() {
        return list.size();
    }


    public class MyViewHolder extends RecyclerView.ViewHolder {
        TextView namaikan, jenisikan,harga,deskripsi;
        ImageView img;

        public MyViewHolder(@NonNull View itemView) {
            super(itemView);
            namaikan = itemView.findViewById(R.id.namaikan_pemesanan);
            jenisikan = itemView.findViewById(R.id.jenisikan_pemesanan);
            harga = itemView.findViewById(R.id.harga_pemesanan);
            deskripsi = itemView.findViewById(R.id.deskripsi_pemesanan);
            img = itemView.findViewById(R.id.img_pemesanan);

        }
    }
}
