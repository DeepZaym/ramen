@extends('layouts.app')

@section('section');

<div class="container">

    <h3>Edit data Ramen</h3>
    <form action="{{ url('/ramen/' . $row->ramen_id) }}" method="POST">
        <input name="_method" type="hidden" value="PATCH"> 
            @csrf
        <table>
            <tr>
                <td>ID</td>
                <td><input type="text" name="ramen_id" value="{{ $row->ramen_id }}"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="ramen_nama" value="{{ $row->ramen_nama }}"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="ramen_deskripsi" value="{{ $row->ramen_deskripsi }}"></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="text" name="ramen_harga" value="{{ $row->ramen_harga }}"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="UPDATE"></td>
            </tr>
        </table>
    </form>
</div>