CREATE TABLE account (
  account_id varchar(50) NOT NULL,
  account_name varchar(50) NOT NULL,
  account_type varchar(50) DEFAULT 'Liabilities',
  remarks varchar(2000) DEFAULT '',
  realm_id varchar(13) NOT NULL,
  email_account varchar(200) NOT NULL,
  ip_address varchar(24) NOT NULL,
  created_by varchar(20) DEFAULT 'admin',
  created_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_by varchar(20) DEFAULT 'admin',
  updated_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  void int(11) DEFAULT 0
);



CREATE TABLE realm (
  realm_id varchar(13) NOT NULL,
  realm_name varchar(2000) NOT NULL,
  realm_key varchar(2000) NOT NULL,
  email_account varchar(200) NOT NULL,
  ip_address varchar(24) NOT NULL,
  created_by varchar(20) NOT NULL DEFAULT 'admin',
  created_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_by varchar(20) NOT NULL DEFAULT 'admin',
  updated_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  void int(11) NOT NULL DEFAULT 0
);


CREATE TABLE transfer (
  transfer_id int(11) NOT NULL,
  from_account varchar(50) NOT NULL,
  to_account varchar(50) NOT NULL,
  amount decimal(20,2) DEFAULT 0.00,
  remarks varchar(2000) DEFAULT NULL,
  realm_id varchar(13) NOT NULL,
  ip_address varchar(24) NOT NULL,
  created_by varchar(20) DEFAULT 'admin',
  created_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_by varchar(20) DEFAULT 'admin',
  updated_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  void int(11) DEFAULT 0
);

--
