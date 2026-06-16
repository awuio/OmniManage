<?php

namespace App\DataTransferObjects;

readonly class ProductData
{
    public function __construct(
        public string $name,
        public ?string $description,
        public float $price,
        public int $quantity,
        public int $category_id,
        public ?string $image = null,
    ) {}

    /**
     * Create DTO from an array input (e.g., from validated request, CLI, or queue).
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            price: (float) $data['price'],
            quantity: (int) $data['quantity'],
            category_id: (int) $data['category_id'],
            image: $data['image'] ?? null,
        );
    }

    /**
     * Convert DTO back to array for Eloquent mass-assignment.
     */
    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'category_id' => $this->category_id,
        ];

        if ($this->image !== null) {
            $data['image'] = $this->image;
        }

        return $data;
    }
}
