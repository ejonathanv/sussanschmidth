<x-website-layout description="Login">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row text-left">
        <div class="col-sm-4">
            <form role="form" method="POST" action="{{ route('login') }}">
                @csrf

                <label class="control-label">E-Mail</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                <label class="control-label">Password</label>
                <input type="password" class="form-control" name="password">

                <button type="submit" class="btn btn-default" style="margin-right: 15px;">Login</button>
            </form>
        </div>
    </div>
</x-website-layout>
