<?php

namespace App\View\Components\Cinematography;

use App\Models\Cinematography;
use Carbon\Carbon;
use Illuminate\View\Component;

class Details extends Component
{
    /**
     * Details size - small.
     *
     * @var string
     */
    const SIZE_SMALL = 'sm';

    /**
     * Details size - large.
     *
     * @var string
     */
    const SIZE_LARGE = 'lg';

    /**
     * Cinematography to display details.
     *
     * @var \App\Models\Cinematography
     */
    protected $cinematography;

    /**
     * Details size.
     *
     * @var string
     */
    protected $size;

    /**
     * Cinematography details component constructor.
     *
     * @param \App\Models\Cinematography $cinematography
     * @param string                     $size
     */
    public function __construct(Cinematography $cinematography, string $size = self::SIZE_SMALL)
    {
        $this->cinematography = $cinematography;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('web.components.cinematography.details')->with([
            'title'          => $this->cinematography->title,
            'type'           => $this->getFormattedType(),
            'original_title' => $this->cinematography->original_title,
            'produced_at'    => $this->cinematography->produced_at->format('Y'),
            'duration'       => $this->getFormattedDuration(),
            'rate'           => $this->cinematography->rating,
            'rates_count'    => $this->getFormattedRatesCount(),
            'size'           => $this->size,
        ]);
    }

    /**
     * Get cinematography formatted duration.
     *
     * @return string|null
     */
    protected function getFormattedDuration(): ?string
    {
        $duration = $this->cinematography->duration;

        if (blank($duration)) {
            return null;
        }

        $duration = Carbon::parse($duration);

        return strtr('hours hoursLabel. minutes minutesLabel.', [
            'hours'        => $duration->format('g'),
            'hoursLabel'   => __('web.views.components.cinematography.details.duration.hours'),
            'minutes'      => $duration->format('i'),
            'minutesLabel' => __('web.views.components.cinematography.details.duration.minutes'),
        ]);
    }

    /**
     * Get cinematography formatted rates count.
     *
     * @return string
     */
    protected function getFormattedRatesCount(): string
    {
        return sprintf(
            '%s %s',
            $this->cinematography->rates_count,
            __('web.views.components.cinematography.details.rates.rates')
        );
    }

    /**
     * Get cinematography formatted type.
     *
     * @return string
     */
    protected function getFormattedType(): string
    {
        return __(
            sprintf('web.views.components.cinematography.details.type.%s', $this->cinematography->type)
        );
    }
}
