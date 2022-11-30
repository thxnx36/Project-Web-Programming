@foreach($places as $place)
    <div class="update-form">
        <form method="post" action="{{ route('update-place', ['place_id' => $place->id]) }}">
            @csrf
            <div class="form-control">
                <table>
                    <tr>
                        <td><label>Place ID :</label></td>
                        <td><input type="text" name="id" value="{{ $place->id }}" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="name">Place Name :</label></td>
                        <td><input type="text" id="name" name="name" value="{{ $place->name }}"></td>
                    </tr>
                    <tr>
                        <td><label>Place Description :</label></td>
                        <td><textarea name="description" row="10" column="10">{{ $place->description }}</textarea></td>
                    </tr>
                    <tr>
                        <td><label>District :</label></td>
                        <td><input type="text" name="district_name" value="{{ $place->district_name }}"></td>
                    </tr>
                </table>
                <button type="submit" name="submit">Update</button>
            </div>
        </form>
    </div>
@endforeach