<?php

class Request {
	
	public static $qetCategoryItems = "SELECT * FROM pf_items
		LEFT JOIN pf_rows_items ON (pf_items.id = pf_rows_items.itmes_id)
		LEFT JOIN pf_rows ON (pf_items.id = pf_rows_items.itmes_id)
		LEFT JOIN pf_columns ON (pf_items.id = pf_rows_items.itmes_id)
	WHERE pf_columns.category_id = ?
	ORDER BY pf_columns.id, pf_rows.id, pf_rows_items.order";

	public static $getCategories = "SELECT * FROM pf_categories ORDER BY order ASC;";

}