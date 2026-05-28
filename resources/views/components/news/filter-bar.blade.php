<div style="position: relative;">
    {{-- Filter Trigger Button --}}
    <div class="filter-button" @click="showFilterDropdown = !showFilterDropdown">
        <img src="{{ asset('images/newsRes/filter.svg') }}" class="filter-image" alt="Filter" />
        <span x-text="selectedChurch === '' ? '{{ __('Filter & Sort') }}' : selectedChurch"></span>
    </div>

    {{-- Dropdown Menu --}}
    <div class="filter-dropdown" 
            x-show="showFilterDropdown" 
            @click.outside="showFilterDropdown = false"
            style="display: none;" 
            x-transition>
        
        {{-- Reset Filter --}}
        {{-- <div class="dropdown-item" @click="selectChurch('')">
            {{ __('All Churches') }}
        </div>

        <template x-for="church in churches" :key="church.id">
            <div class="dropdown-item" 
                    @click="selectChurch(church.name)"
                    x-text="church.name">
            </div>
        </template> --}}

        <div style="border-top: 1px solid #ddd; margin-top: 5px;"></div>
        
        {{-- Sort Toggle --}}
        <div class="dropdown-item" @click="toggleSort()">
            <span x-text="sortOrder === 'desc' ? '{{ __('Oldest First') }}' : '{{ __('Newest First') }}'"></span>
        </div>
    </div>
</div>