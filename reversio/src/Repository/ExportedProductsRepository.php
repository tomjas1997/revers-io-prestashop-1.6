<?php
/**
 *Copyright (c) 2019 Revers.io
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author revers.io
 * @copyright Copyright (c) permanent, Revers.io
 * @license   Revers.io
 * @see       /LICENSE
 */

namespace ReversIO\Repository;

use Db;
use DbQuery;

class ExportedProductsRepository
{
    public function isProductExported($productId)
    {
        $query = new DbQuery();

        $query->select('id');
        $query->from('revers_io_exported_products');
        $query->where('id_product = "' . (int) $productId . '"');

        return Db::getInstance()->getValue($query);
    }

    public function updateExportedProduct($productId)
    {
        $now = new \DateTime();

        $sql = 'UPDATE '._DB_PREFIX_.'revers_io_exported_products
                SET update_date = "'.pSQL($now->format("Y-m-d H:i:s")).'"
                WHERE id_product = "'. (int) $productId.'"';

        return Db::getInstance()->execute($sql);
    }

    public function insertExportedProducts($productId, $reversIOProductId)
    {
        $now = new \DateTime();

        $sql = 'INSERT INTO '._DB_PREFIX_.'revers_io_exported_products (id_product, add_date, reversio_product_id)
                            VALUES ("'. (int) $productId.'", "'.pSQL($now->format("Y-m-d H:i:s")).'", "'.pSQL($reversIOProductId).'")';

        return Db::getInstance()->execute($sql);
    }

    public function getReversioProductIdByProductId($productId)
    {
        $query = new DbQuery();

        $query->select('reversio_product_id');
        $query->from('revers_io_exported_products');
        $query->where('id_product = "' . (int)$productId . '"');
        $reversioProductId = Db::getInstance()->getValue($query);

        return $reversioProductId ? $reversioProductId : null;
    }
}
