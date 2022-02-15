<div>
    <input type="text" class="form-control" placeholder="Search..." wire:model="query">
    <div class="form-control absolute z-10 list-group bg-white w-full ">
        <select>
        @foreach ($results as $result)
            <option>
                {{ $result->bookTitle }}
            </option>
        @endforeach
        </select>
    </div>
</div>
