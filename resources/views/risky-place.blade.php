@extends('header')
    <head>
        <style>
            ::-webkit-input-placeholder {
                font-size: 13px;
                text-align: left;
            }
            .table-content {
                width: 700px;
                margin: auto;
            }
            .table {
                text-align: center;
            }
            .table th {
                text-align: center;
            }
            .modalButton {
                text-align: center;
            }
        </style>
    </head>
@section('content')
    <div style="margin-top: 20px; text-align: center;">
        <form method="get" action="{{ route('risky-place-page') }}">
            <input type="search" id="search" name="search" style="height: 25px;" placeholder="ค้นหาด้วยชื่อ, คำอธิบาย, อำเภอ" value="{{ $term }}">
            <button type="submit" class="btn btn-primary btn-sm" style="font-size: 12px; margin-bottom: 3.5px;">ค้นหา</button>
        </form>
    </div>
    <div class="table-content">
        <table class="table">
            <th>ชื่อสถานที่</th><th>เกี่ยวกับสถานที่</th><th>อำเภอ</th>
            @foreach($locations as $loc)
                @foreach($districts as $dist)
                    @if ($dist->name == $loc->district_name)
                        <tr>
                            <td>{{ $loc->name }}</td>
                            <td>{{ $loc->description }}</td>
                            <td>{{ $dist->name }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </table>
    </div>
    <div>
        {{ $locations->withQueryString()->links() }}
    </div>
@endsection