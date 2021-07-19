package com.viss.pemesanan.Model;

import java.io.Serializable;

public class Cupang implements Serializable {
    String nama, harga, id, img_url, stock, jenis,deskripsi;

    public Cupang() {
    }

    public Cupang(String nama, String harga, String id, String img_url, String stock, String jenis, String deskripsi) {
        this.nama = nama;
        this.harga = harga;
        this.id = id;
        this.img_url = img_url;
        this.stock = stock;
        this.jenis = jenis;
        this.deskripsi = deskripsi;
    }

    public String getDeskripsi() {
        return deskripsi;
    }

    public void setDeskripsi(String deskripsi) {
        this.deskripsi = deskripsi;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getHarga() {
        return harga;
    }

    public void setHarga(String harga) {
        this.harga = harga;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getImg_url() {
        return img_url;
    }

    public void setImg_url(String img_url) {
        this.img_url = img_url;
    }

    public String getStock() {
        return stock;
    }

    public void setStock(String stock) {
        this.stock = stock;
    }

    public String getJenis() {
        return jenis;
    }

    public void setJenis(String jenis) {
        this.jenis = jenis;
    }
}
