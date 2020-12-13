<div class="cinematography-details cinematography-details-{{ $size }}">
    <span class="badge badge-pill badge-primary badge">
        {{ $type }}
    </span>
    <div class="cinematography-details-content">
        <h2 class="cinematography-details-content-title">
            {{ $title }}
        </h2>
        <div class="cinematography-details-row">
            @isset($original_title)
                <span class="cinematography-details-content-text">
                    {{ $original_title }}
                </span>
            @endisset

            <span class="cinematography-details-content-text">
                {{ $produced_at }}
            </span>

            @isset($duration)
                <span class="cinematography-details-content-text">
                    {{ $duration }}
                </span>
            @endisset
        </div>
    </div>
    <div class="cinematography-details-rates">
            <span class="badge badge-pill badge-primary badge">
                {{ $rate }}
            </span>
        <span class="cinematography-details-content-text">
                {{ $rates_count }}
            </span>
    </div>
</div>
