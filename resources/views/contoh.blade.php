<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Data Kelurahan
    <table border=1>
        <thead>
            <tr>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Kecamatan</th>
                
            </tr>
        </thead>
        <tbody>
            @php
                $level1 = '';
                $level2 = '';
                $level3 = '';
            @endphp
            @foreach ($data as $item)
                <tr>
                    @if ($level1 != $item->nama)
                        <td rowspan="{{$item->merge_prov}}">{{$item->nama}} </td>
                        @php
                        $level1 = $item->nama;
                        @endphp
                    @endif

                @foreach ($item->kota as $item2)
                    @if ($level2 != $item2->nama)
                
                        <td rowspan="{{$item2->merge_kota}}">{{$item2->nama}}</td>
                        @php
                        $level2 = $item2->nama;
                        @endphp
                    @endif

                    @if (count($item2->kecamatan)) == 0)
                        <td>fsdf</td>
                    </tr>
                        @else
                            

                        

                    @foreach ($item2->kecamatan as $item3)
                    <td>{{$item3->nama}}</td>
                            
                        {{-- <tr> --}}
                            {{-- @if ($level1 != $item->nama)
                                <td rowspan="{{count($item2->kecamatan)}}">{{$item->nama}} </td>
                                @php
                                $level1 = $item->nama;
                                @endphp
                            @endif
                            @if ($level2 != $item2->nama)
                                <td rowspan="{{count($item2->kecamatan)}}">{{$item2->nama}}</td>
                                @php
                                $level2 = $item2->nama;
                                @endphp
                            @endif --}}
                            
                            
                            {{-- <td>{{$item->nama}}</td>
                            <td>{{$item2->nama}}</td> --}}
                        </tr>
                    @endforeach

                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>