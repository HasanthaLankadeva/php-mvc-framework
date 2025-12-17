<?php
class Product
{
	private QueryBuilder $qb;


	public function __construct()
	{
		$this->qb = new QueryBuilder('products');
	}

	/**
    * Get all posts
    */
    public function all(): array
    {
        return $this->qb->all();
    }
	
	/**
    * Find single post
    */
    public function find(int $id): ?array
    {
        return $this->qb->find($id);
    }

	/**
    * Create post
    */
    public function create(array $data): bool
    {
        return $this->qb->insert([
            'product_name'   => $data['product_name'],
            'price' => $data['price']
        ]);
    }

    /**
    * Update post
    */
    public function update(int $id, array $data): bool
    {
        return $this->qb->update($id, [
            'product_name'   => $data['product_name'],
            'price' => $data['price']
        ]);
    }

    /**
    * Delete post
    */
    public function delete(int $id): bool
    {
        return $this->qb->delete($id);
    }
}

?>