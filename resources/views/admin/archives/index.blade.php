<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-folder-outline"></i> My Archives
            </h2>
        </div>

        <a href="#" class="btn btn-default">
            Add new archive
        </a>

        <table id="archives-table" class="table table-sm table-striped">
            <thead>
                <tr>
                    <th style="width: 70px">Image</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($archives as $archive)
                <tr>
                    <td style="vertical-align: middle;">
                        <figure style="background-image: url('{{ asset($archive->image) }}')"></figure>
                    </td>
                    <td style="vertical-align: middle;" class="item-title">
                        <a href="#">{{ $archive->title }}</a>
                    </td>
                    <td style="vertical-align: middle;">{{ $archive->year }}</td>
                    <td style="vertical-align: middle;" class="text-right">
                        <a href="#" style="margin-right: 1rem">
                            <i class="ion-edit"></i> EDIT
                        </a>
                        <form method="POST" action="" class="remove-item-form" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-item">
                                <i class="ion-close-round"></i> REMOVE
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $archives->links('pagination::bootstrap-4') }}
    </div>
</x-admin-layout>