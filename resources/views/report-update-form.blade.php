@foreach($reports as $report)
    <form method="post" action="{{ route('update-report', ['report_date' => $report->date]) }}">
        @csrf
        <div class="form-control">
                <table>
                    <tr>
                        <td><label>วันที่ :</label></td>
                        <td><input type="text" name="date" value="{{ $report->date }}" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="name">ตรวจพบเชิงรุก :</label></td>
                        <td><input type="text" name="n_pmc" value="{{ $report->n_pmc }}"></td>
                    </tr>
                    <tr>
                        <td><label>ตรวจพบในที่คุมขัง :</label></td>
                        <td><input type="text" name="n_prison" value="{{ $report->n_prison }}"></td>
                    </tr>
                    <tr>
                        <td><label>ตรวจพบจากผู้เดินทางจากต่างประเทศ :</label></td>
                        <td><input type="text" name="n_ft" value="{{ $report->n_ft }}"></td>
                    </tr>
                    <tr>
                        <td><label>รักษาหาย :</label></td>
                        <td><input type="text" name="n_recovered" value="{{ $report->n_recovered }}"></td>
                    </tr>
                    <tr>
                        <td><label>เสียชีวิต :</label></td>
                        <td><input type="text" name="n_death" value="{{ $report->n_death }}"></td>
                    </tr>
                </table>
                <button type="submit" name="submit">Update</button>
            </div>
    </form>
@endforeach