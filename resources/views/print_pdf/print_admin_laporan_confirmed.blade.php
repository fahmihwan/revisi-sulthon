<table>
    <thead>
        <tr>
            <td> <b style="font-size: 30px">Outlaws Studio</b></td>
        </tr>
        <tr>
            <td> <b style="font-size: 30px">{{ $title }}</b></td>
        </tr>
        <tr>
            <td>Periode {{ $periode['start_date'] }} sampai {{ $periode['end_date'] }}</td>
        </tr>
        <tr>
            <td>Tanggal {{ $current_date }}</td>
        </tr>
    </thead>
</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Pesanan</th>
            <th>Tanggal</th>
            <th>Email</th>
            <th>Total</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nota }}</td>
                <td>{{ $item->tanggal_pembelian }}</td>
                <td>{{ $item->user->email }}</td>
                <td>
                    Rp. {{ number_format($item->total, 0, '', '.') }}
                </td>
                <td>
                    <ul>
                        @foreach ($item->detail_penjualans as $child)
                            <li>{{ $child->item->nama }}</li>
                        @endforeach
                    </ul>

                </td>
            </tr>
        @endforeach

    </tbody>

</table>
{{-- 
<td class="py-4 ">
    {{ $item->user->email }}
</td>
<td class="py-4 ">
    Rp. {{ number_format($item->total, 0, '', '.') }}
</td>
<td class="py-4 ">
    <ul class="list-disc list-inside">
        @foreach ($item->detail_penjualans as $child)
            <li>{{ $child->item->nama }}</li>
        @endforeach
    </ul>
</td> --}}
