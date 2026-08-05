<?php

namespace App\Services\Cart;

use App\Data\Requests\Cart\AddCartItemData;
use App\Data\Requests\Cart\UpdateCartItemData;
use App\Data\Responses\Cart\CartData;
use App\Exceptions\InsufficientStockException;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CartService
{
    /**
     * Получить корзину пользвателя
     */
    public function getUserCart(User $user): CartData
    {
        return CartData::fromModel(
            $this->getCart($user)
        );
    }

    /**
     * Добавить товар в корзину
     */
    public function addItem(User $user, AddCartItemData $data): CartData
    {
        $cart = $this->getCart($user);

        $variant = ProductVariant::query()
            ->findOrFail($data->product_variant_id);

        $this->validateStock($variant, $data->quantity);

        DB::transaction(function () use ($cart, $variant, $data) {

            $cart->items()->updateOrCreate(
                ['product_variant_id' => $variant->id],
                [
                    'quantity' => $data->quantity,
                    'is_selected' => true,
                ]
            );
        });
        return CartData::fromModel($this->getCart($user));
    }

    /**
     * Обновить количество товара
     */
    public function updateItem(
        User $user,
        CartItem $item,
        UpdateCartItemData $data,
    ): CartData {
        $variant = $item->productVariant;
        $this->validateStock($variant, $data->quantity);
        $item->update(['quantity' => $data->quantity]);
        return CartData::fromModel($this->getCart($user));
    }

    /**
     * Удалить товар из корзины
     */
    public function removeItem(User $user, CartItem $item): CartData
    {
        $item->delete();
        return CartData::fromModel($this->getCart($user));
    }

    /**
     * Снять/установить выделение варианта товара
     */
    public function toggleItem(User $user, CartItem $item): CartData
    {
        $item->update(['is_selected' => ! $item->is_selected,]);
        return CartData::fromModel($this->getCart($user));
    }

    /**
     * Очистить всю корзину
     */
    public function clear(User $user): void
    {
        $cart = $this->getCart($user);
        $cart->items()->delete();
    }

    /**
     * Получить/создать запрос корзины пользователя
     */
    private function getCart(User $user): Cart
    {
        return Cart::query()
            ->withCartRelations()
            ->firstOrCreate(
                ['user_id' => $user->id]
            );
    }

    /**
     * Проверка количество отстатков товара
     */
    private function validateStock(ProductVariant $variant, int $quantity): void
    {
        if ($quantity > $variant->stock) {
            throw new InsufficientStockException(
                availableStock: $variant->stock,
                requestedQuantity: $quantity,
            );
        }
    }
}
