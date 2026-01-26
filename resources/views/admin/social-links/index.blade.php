<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-social-rss-outline"></i> Social Links
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('social-links.create') }}" class="btn btn-default">
                    <i class="ion-plus-round"></i> Add new social link
                </a>
            </div>
            <div class="col-md-6 text-right">
                <small class="text-muted">Drag and drop to reorder</small>
            </div>
        </div>

        <table id="archives-table" class="table table-sm table-striped">
            <thead>
                <tr>
                    <th style="width: 60px">Icon</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>

            <tbody id="sortable-container">
                @forelse($socialLinks as $socialLink)
                <tr data-id="{{ $socialLink->id }}" class="sortable-item">
                    <td style="vertical-align: middle;">
                        <i class="{{ $socialLink->icon }}" style="font-size: 1.5rem;"></i>
                    </td>
                    <td style="vertical-align: middle;">
                        {{ $socialLink->name }}
                    </td>
                    <td style="vertical-align: middle;">
                        <a href="{{ $socialLink->url }}" target="_blank" class="text-muted">{{ Str::limit($socialLink->url, 40) }}</a>
                    </td>
                    <td style="vertical-align: middle;">
                        <span class="badge badge-secondary">{{ $socialLink->order }}</span>
                    </td>
                    <td style="vertical-align: middle;">
                        @if($socialLink->active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle;" class="text-right">
                        <a href="{{ route('social-links.edit', $socialLink) }}" style="margin-right: 1rem">
                            <i class="ion-edit"></i> EDIT
                        </a>
                        
                        <form method="POST" action="{{ route('social-links.toggle', $socialLink) }}" style="display: inline;" class="mr-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $socialLink->active ? 'btn-warning' : 'btn-success' }}" title="{{ $socialLink->active ? 'Deactivate' : 'Activate' }}">
                                <i class="ion-{{ $socialLink->active ? 'android-done-all' : 'android-done' }}"></i>
                                {{ $socialLink->active ? 'OFF' : 'ON' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('social-links.destroy', $socialLink) }}" class="remove-item-form" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this social link?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-item">
                                <i class="ion-close-round"></i> REMOVE
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <p>No social links found. Create your first social link!</p>
                        <a href="{{ route('social-links.create') }}" class="btn btn-default">Create Social Link</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($socialLinks->isNotEmpty())
            <div class="mt-3 text-muted">
                <small>
                    Showing {{ $socialLinks->count() }} social links
                </small>
            </div>
        @endif
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sortable-container").sortable({
                items: '.sortable-item',
                axis: 'y',
                handle: 'tr',
                placeholder: "sortable-placeholder",
                helper: function(e, tr) {
                    var $originals = tr.children();
                    var $helper = tr.clone();
                    $helper.children().each(function(index) {
                        $(this).width($originals.eq(index).width());
                    });
                    return $helper;
                },
                update: function(event, ui) {
                    var orders = {};
                    $('#sortable-container .sortable-item').each(function(index) {
                        var id = $(this).data('id');
                        orders[id] = index;
                    });

                    $.post('{{ route("social-links.reorder") }}', {
                        _token: '{{ csrf_token() }}',
                        orders: orders
                    }).done(function(response) {
                        if (response.success) {
                            // Update order badges
                            $('#sortable-container .sortable-item').each(function(index) {
                                $(this).find('.badge-secondary').text(index);
                            });
                        }
                    });
                }
            });
        });
    </script>

    <style>
        .sortable-placeholder {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            height: 50px;
        }
        
        .sortable-item {
            cursor: move;
        }
        
        .sortable-item:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-secondary {
            background-color: #6c757d;
        }
    </style>
    @endpush
</x-admin-layout>