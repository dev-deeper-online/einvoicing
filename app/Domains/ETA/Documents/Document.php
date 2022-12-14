<?php

namespace App\Domains\ETA\Documents;

use App\Domains\ETA\Documents\Concerns\Buildable;
use App\Domains\ETA\Documents\Concerns\InteractsWithAmount;
use App\Domains\ETA\Documents\Concerns\InteractsWithCustomer;
use App\Domains\ETA\Documents\Concerns\InteractsWithItems;
use App\Domains\ETA\Documents\Concerns\InteractsWithSeller;
use App\Domains\ETA\Documents\Concerns\Signable;
use App\Domains\ETA\Documents\Concerns\Submittable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

abstract class Document implements Arrayable
{
    use Buildable;
    use Signable;
    use Submittable;
    use InteractsWithCustomer;
    use InteractsWithAmount;
    use InteractsWithItems;
    use InteractsWithSeller;

    /**
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * @var string|null
     */
    protected ?string $version = null;

    /**
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * @var Carbon|null
     */
    protected ?Carbon $date = null;

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param  string|null  $id
     * @return Document
     */
    public function setId(?string $id): Document
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Carbon|null
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @param  Carbon|null  $date
     * @return Document
     */
    public function setDate(?Carbon $date): Document
    {
        $this->date = $date;

        return $this;
    }
}
