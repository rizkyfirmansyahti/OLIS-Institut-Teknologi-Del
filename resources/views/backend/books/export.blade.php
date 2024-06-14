<!-- export book modal -->
<div class="modal fade" id="exportBook" tabindex="-1" role="dialog" aria-labelledby="exportBookLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('backend.books.export') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exportBookLabel">Export Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="columns">Select Columns to Export</label><br>
                        @php
                            $columns = [
                                'code',
                                'title',
                                'slug',
                                'author',
                                'isbn',
                                'cover',
                                'description',
                                'publisher',
                                'language',
                                'edition',
                                'subject',
                                'classification',
                                'cp_or',
                                'year',
                                'location',
                                'status',
                                'created_at',
                            ];
                        @endphp
                        @foreach ($columns as $column)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="{{ $column }}"
                                    name="columns[]" value="{{ $column }}">
                                <label class="form-check-label" for="{{ $column }}">{{ ucfirst($column) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>
