<x-website-layout description="Exhibitions">
    <div class="admin-header text-left">
        <div class="row">
            <div class="col-sm-6">
                <h2 icon-title>Exhibitions</h2>
            </div>
        </div>
    </div>

    <p class="lead">Solo</p>

    <table class="table">
        @foreach($solo_exhibitions as $exhibition)
        <tr>
            <td width="15%"><b>{{ $exhibition->year }}</b></td>
            <td width="40%">{{ $exhibition->title }} @if($exhibition->subtitle) <br> <small>"{{ $exhibition->subtitle }}"</small> @endif</td>
            <td width="45%">{{ $exhibition->location }} @if($exhibition->place) <br> <small>{{ $exhibition->place }}</small> @endif</td>
        </tr>
        @endforeach
    </table>

    <p class="lead">Group</p>

    <table class="table">
        @foreach($group_exhibitions as $exhibition)
        <tr>
            <td width="15%"><b>{{ $exhibition->year }}</b></td>
            <td width="40%">{{ $exhibition->title }} @if($exhibition->subtitle) <br> <small>"{{ $exhibition->subtitle }}"</small> @endif</td>
            <td width="45%">{{ $exhibition->location }} @if($exhibition->place) <br> <small>{{ $exhibition->place }}</small> @endif</td>
        </tr>
        @endforeach
    </table>
</x-website-layout>