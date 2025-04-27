@extends('UserDashboard.Layout.userBaseview')

@section('dashContent')
    <div class="container">
        <a href="{{ route('bookings.add') }}" class="btn btn-primary mb-2 float-end">Create New Booking</a>
        <table class="table table-light table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Booking Name</th>
                    <th scope="col">Booked for</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>             
                @php $i = 1; @endphp    
                @foreach($bookings as $booking)  <!-- Change 'data' to 'bookings' -->
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ @$booking->user_name }}</td>
                    <td>{{ @$booking->name }}</td>
                    <td>{{ @$booking->booking_datetime }}</td>
                    <td>
                        <div class="dropdown">
                            <span class="bi bi-list"></span>
                            <div class="dropdown-content">
                                <a href="{{ route('bookings.edit', ['id' => $booking->id]) }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>                     
                                <form action="{{ route('bookings.delete', ['id' => $booking->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')  <!-- Using DELETE method -->
                                    <button type="submit" class="btn btn-link">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
