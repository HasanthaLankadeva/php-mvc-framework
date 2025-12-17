<?php
class Enquiry
{
	private QueryBuilder $qb;


	public function __construct()
	{
		$this->qb = new QueryBuilder('enquiries');
	}

	/**
    * Create post
    */
    public function create(array $data): bool
    {
        return $this->qb->insert($data);
    }

}

?>