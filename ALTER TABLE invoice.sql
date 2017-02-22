ALTER TABLE invoice
ADD item_13 VARCHAR(50) AFTER cost_12,
ADD start_date_13 DATE AFTER item_13,
ADD end_date_13 DATE AFTER start_date_13,
ADD deduction_13 FLOAT AFTER end_date_13,
ADD base_cost_13 FLOAT AFTER deduction_13,
ADD cost_13 FLOAT AFTER base_cost_13,
ADD payment_13 FLOAT AFTER payment_12_check_num,
ADD payment_13_date DATE AFTER payment_13,
ADD payment_13_type VARCHAR(35) AFTER payment_13_date,
ADD payment_13_check_num VARCHAR(25) AFTER payment_13_type