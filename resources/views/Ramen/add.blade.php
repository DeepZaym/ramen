
@section('content')

<div class="container"> 
    <h3>Tambah Data Ramen</h3> 
    <form action="{{ url('/ramen') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>ID</td>
                <td><input type="text" name="ramen_id"></td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td><input type="text" name="ramen_nama"></td>
            </tr> 
            <tr>
                <td>DESKRIPSI</td>
                <td><input type="text" name="ramen_deskripsi"></td>
            </tr>
            <tr>
                <td>HARGA</td>
                <td><input type="text" name="ramen_harga"></td>
            </tr>
            <tr>
                <td><td>
                <td>
                    <input type="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
</div>