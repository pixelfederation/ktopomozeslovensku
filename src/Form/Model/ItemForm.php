<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Form\Model;

/**
 *
 */
interface ItemForm
{
    /**
     * @return array|null
     */
    public function getItems(): ?array;

    /**
     * @param array|null $items
     *
     * @return void
     */
    public function setItems(?array $items): void;
}
