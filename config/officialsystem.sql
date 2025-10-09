CREATE TABLE users(
    uid VARCHAR(255) NOT NULL,
    uname VARCHAR(255) NOT NULL,
    uemail VARCHAR(255) NOT NULL,
    uphone VARCHAR(255) NOT NULL,
    upass VARCHAR(255) NOT NULL,
    ustatus VARCHAR(255) NOT NULL DEFAULT '2' COMMENT '1 inactive 2 active',
    ucountryid VARCHAR(255) NOT NULL DEFAULT 'USDT',
    upackage VARCHAR(255) NULL,
    ujoin TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    active TINYINT NOT NULL DEFAULT '1',
    lon VARCHAR(255) NULL,
    l1 VARCHAR(255) NOT NULL DEFAULT 'None',
    l2 VARCHAR(255) NOT NULL DEFAULT 'None',
    l3 VARCHAR(255) NOT NULL DEFAULT 'None',
    emailed TINYINT NOT NULL DEFAULT '0' COMMENT '0 is for not approved 1 = rejected 2 = accepted',
    subscription TINYINT NOT NULL,
    location TINYINT NOT NULL,
    locationname VARCHAR(255) NULL,
    lat VARCHAR(255) NULL,
    darkmode TINYINT NULL,
    PRIMARY KEY(uid)
);

CREATE TABLE cart(
    cid VARCHAR(255) NOT NULL,
    cuid VARCHAR(255) NOT NULL,
    cimage VARCHAR(255) NOT NULL,
    cname VARCHAR(255) NOT NULL,
    camount DECIMAL(20, 2) NOT NULL,
    cstatus TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cdate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(cid),
    FOREIGN KEY (cuid) REFERENCES users(uid)
);

CREATE TABLE balances(
    buid VARCHAR(255) NOT NULL,
    profit DECIMAL(20, 2) NOT NULL DEFAULT '0',
    balance DECIMAL(20, 2) NOT NULL DEFAULT '0',
    whatsapp DECIMAL(20, 2) NOT NULL DEFAULT '0',
    cashback DECIMAL(20, 2) NOT NULL DEFAULT '0',
    deposit DECIMAL(20, 2) NOT NULL DEFAULT '0',
    withdrawn DECIMAL(20, 2) NOT NULL DEFAULT '0',
    whatsappwithdrawn DECIMAL(20, 2) NOT NULL DEFAULT '0',
    cashbackwithdrawn DECIMAL(20, 2) NOT NULL DEFAULT '0',
    invested DECIMAL(20, 2) NOT NULL DEFAULT '0',
    ads DECIMAL(20, 2) NOT NULL DEFAULT '0',
    youtube DECIMAL(20, 2) NOT NULL DEFAULT '0',
    tiktok DECIMAL(20, 2) NOT NULL DEFAULT '0',
    trivia DECIMAL(20, 2) NOT NULL DEFAULT '0',
    meme DECIMAL(20, 2) NOT NULL DEFAULT '0',
    way1 DECIMAL(20, 2) NOT NULL DEFAULT '0',
    way2 DECIMAL(20, 2) NOT NULL DEFAULT '0',
    way3 DECIMAL(20, 2) NOT NULL DEFAULT '0',
    PRIMARY KEY(buid),
    FOREIGN KEY (buid) REFERENCES users(uid)
);

CREATE TABLE session(
    sid VARCHAR(255) NOT NULL,
    suid VARCHAR(255) NOT NULL,
    stoken VARCHAR(255) NOT NULL,
    sdevice LONGTEXT NULL,
    sexpiry TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    screated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(sid),
    FOREIGN KEY (suid) REFERENCES users(uid)
);

CREATE TABLE pages(
    pid VARCHAR(255) NOT NULL,
    pname VARCHAR(255) NOT NULL,
    pfile VARCHAR(255) NOT NULL,
    pcss VARCHAR(255) NOT NULL,
    ptitle VARCHAR(255) NOT NULL,
    pdesc VARCHAR(255) NOT NULL,
    pstatus TINYINT NOT NULL,
    pauth TINYINT NOT NULL,
    PRIMARY KEY(pid)
);

CREATE TABLE userteam(
    id VARCHAR(255) NOT NULL,
    parent_id VARCHAR(255) NOT NULL,
    child_id VARCHAR(255) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (parent_id) REFERENCES users(uid),
    FOREIGN KEY (child_id) REFERENCES users(uid)
);

CREATE TABLE uploads(
    pid VARCHAR(255) NOT NULL,
    puid VARCHAR(255) NOT NULL,
    puname VARCHAR(255) NOT NULL,
    pimage VARCHAR(255) NOT NULL DEFAULT 'none.jpg',
    pviews VARCHAR(255) NOT NULL,
    pamount DECIMAL(20, 2) NOT NULL DEFAULT '0',
    pdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    pstatus VARCHAR(255) NOT NULL,
    PRIMARY KEY(pid),
    FOREIGN KEY (puid) REFERENCES users(uid)
);

CREATE TABLE countrys(
    cid VARCHAR(255) NOT NULL,
    cname VARCHAR(255) NOT NULL,
    ccapital VARCHAR(255) NOT NULL,
    cuabrv VARCHAR(255) NOT NULL,
    ccall VARCHAR(255) NOT NULL,
    ccurrency VARCHAR(255) NOT NULL,
    crate DECIMAL(20, 8) NOT NULL DEFAULT '0',
    ctimezone VARCHAR(255) NOT NULL,
    cupdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(cid)
);

CREATE TABLE site(
    sid VARCHAR(255) NOT NULL,
    sname VARCHAR(255) NOT NULL,
    semail VARCHAR(255) NOT NULL,
    sphone VARCHAR(255) NOT NULL,
    slogo VARCHAR(255) NOT NULL,
    saffiliate TINYINT NOT NULL DEFAULT '0',
    slink VARCHAR(255) NOT NULL,
    scare1 VARCHAR(255) NOT NULL,
    scare2 VARCHAR(255) NOT NULL,
    scare3 VARCHAR(255) NOT NULL,
    payment TINYINT NOT NULL DEFAULT '1',
    bankno VARCHAR(255) NOT NULL,
    accno VARCHAR(255) NOT NULL,
    reflevel VARCHAR(255) NOT NULL,
    PRIMARY KEY(sid)
);

CREATE TABLE transactions(
    tid VARCHAR(255) NOT NULL,
    tuid VARCHAR(255) NOT NULL,
    tuname VARCHAR(255) NOT NULL,
    tuphone VARCHAR(255) NOT NULL,
    ttype VARCHAR(255) NOT NULL,
    tcat TINYINT NOT NULL DEFAULT '2',
    tamount DECIMAL(20, 2) NOT NULL DEFAULT '0',
    tstatus VARCHAR(255) NOT NULL,
    tprebalance DECIMAL(20, 2) NOT NULL DEFAULT '0',
    tbalance DECIMAL(20, 2) NOT NULL DEFAULT '0',
    tpredeposit DECIMAL(20, 2) NOT NULL DEFAULT '0',
    tdeposit DECIMAL(20, 2) NOT NULL DEFAULT '0',
    tdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    tduedate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    trefuname VARCHAR(255) NOT NULL,
    trefuid VARCHAR(255) NOT NULL,
    tstate TINYINT NOT NULL DEFAULT '1',
    PRIMARY KEY(tid),
    FOREIGN KEY (tuid) REFERENCES users(uid)
);

CREATE TABLE affiliatefee(
    cid VARCHAR(255) NOT NULL,
    creg DECIMAL(8, 2) NOT NULL,
    fl1 DECIMAL(8, 2) NOT NULL,
    fl2 DECIMAL(8, 2) NOT NULL,
    fl3 DECIMAL(8, 2) NOT NULL,
    active TINYINT NOT NULL DEFAULT '1' COMMENT 'this can be suspended for a while',
    PRIMARY KEY(cid)
);

CREATE TABLE product(
    pid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    puid VARCHAR(255) NOT NULL,
    pname VARCHAR(255) NOT NULL,
    pimage VARCHAR(255) NOT NULL,
    pcategory VARCHAR(255) NOT NULL,
    pprice DECIMAL(20, 2) NOT NULL,
    pdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (puid) REFERENCES users(uid)
);

CREATE TABLE package(
    pid VARCHAR(255) NOT NULL,
    pname VARCHAR(255) NOT NULL,
    pcategory VARCHAR(255) NOT NULL,
    pprice DECIMAL(20, 2) NOT NULL DEFAULT '0',
    pimage VARCHAR(255) NOT NULL,
    pstatus TINYINT NOT NULL DEFAULT '1',
    PRIMARY KEY(pid)
);


-- Foreign key constraints for existing tables
ALTER TABLE users ADD CONSTRAINT users_ucountryid_foreign FOREIGN KEY(ucountryid) REFERENCES countrys(cid);
ALTER TABLE users ADD CONSTRAINT users_upackage_foreign FOREIGN KEY(upackage) REFERENCES package(pid);



--!perfomed code

CREATE TABLE `payment_method` (
  `pid` varchar(255) NOT NULL,
  `cid` varchar(255) NOT NULL DEFAULT 'USDT',
  `ptype` varchar(255) NOT NULL DEFAULT '1' COMMENT '0 = None \r\n0 = Till \r\n2 = Mpesa-paybill \r\n3 = Kenyan Bank \r\n3 = Links\r\n4 = Automated',
  `method_name` varchar(255) NOT NULL DEFAULT 'None',
  `till_number` varchar(255) NOT NULL DEFAULT '0',
  `business_number` varchar(255) NOT NULL DEFAULT '0',
  `account_no` varchar(255) NOT NULL DEFAULT '000 000',
  `automated` tinyint(1) NOT NULL DEFAULT 0,
  `extra` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_procedure`
--

CREATE TABLE `payment_procedure` (
  `pid` varchar(255) NOT NULL,
  `pmethod_id` varchar(255) DEFAULT 'NONE',
  `step_no` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `fk_country` (`cid`);

--
-- Indexes for table `payment_procedure`
--
ALTER TABLE `payment_procedure`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `fk_payment_method` (`pmethod_id`);


ALTER TABLE `transactions`
ADD COLUMN `payment_type` varchar(255) NOT NULL DEFAULT 'NONE',
ADD COLUMN `ref_payment` varchar(255) DEFAULT NULL;



ALTER TABLE `transactions`
  ADD UNIQUE KEY `uq_ref_payment` (`ref_payment`),
  ADD KEY `fr_payment_method` (`payment_type`);


ALTER TABLE `payment_method`
  ADD CONSTRAINT `fk_country` FOREIGN KEY (`cid`) REFERENCES `countrys` (`cid`) ON UPDATE CASCADE;

--
-- Constraints for table `payment_procedure`
--
ALTER TABLE `payment_procedure`
  ADD CONSTRAINT `fk_payment_method` FOREIGN KEY (`pmethod_id`) REFERENCES `payment_method` (`pid`) ON UPDATE CASCADE;

--
INSERT INTO `payment_method` (`pid`, `cid`, `ptype`, `method_name`, `till_number`, `business_number`, `account_no`, `automated`, `extra`) VALUES
('NONE', 'USDT', '1', 'None', '0', '0', '000 000', 0, NULL);



ALTER TABLE `transactions`
  ADD CONSTRAINT `fr_payment_method` FOREIGN KEY (`payment_type`) REFERENCES `payment_method` (`pid`);

--


ALTER TABLE users
ADD UNIQUE KEY  uq_uname (uname)

change to be nulll both phone and email

UPDATE users 
SET uemail = NULL, uphone = NULL 
WHERE uemail IN (
    SELECT uemail
    FROM (
        SELECT uemail
        FROM users
        GROUP BY uemail
        HAVING COUNT(uemail) > 1
    ) AS duplicates
);


UPDATE users 
SET uemail = NULL, uphone = NULL 
WHERE uphone IN (
    SELECT uphone
    FROM (
        SELECT uphone
        FROM users
        GROUP BY uphone
        HAVING COUNT(uphone) > 1
    ) AS duplicates
);

ALTER TABLE users
ADD UNIQUE KEY uq_uemail (uemail)

ALTER TABLE users
ADD UNIQUE KEY uq_uphone (uphone)


UPDATE users SET emailed = true;
UPDATE users SET emailed = false WHERE uemail IS NULL OR uphone IS NULL;

-- ALLBALANCES

SELECT u.uname AS UserName, b.balance AS Current_Balance, c.cname FROM `balances` b
INNER JOIN users u
ON u.uid = b.buid
INNER JOIN countrys c
ON c.cid = u.ucountryid
WHERE balance >= 500 AND buid NOT IN ('AC8630F55F', 'C93BE60D42') LIMIT 500

-- quizeess


-- ADD ED SOMTHING TO THE TRANSACTION TABLE

ALTER TABLE transactions
ADD ttype_id VARCHAR(255) DEFAULT NULL

CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    activity_type TINYINT NOT NULL DEFAULT 0,
    description VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO activities (activity_type, description) VALUES
(0, 'Others'),
(1, 'WhatsApp'),
(2, 'Profits'),
(3, 'Withdrawal'),
(4, 'Transfer'),
(5, 'Academic'),
(6, 'Spent'),
(7, 'Deposit'),
(8, 'Investment'),
(9, 'Trivia'),
(10, 'YouTube'),
(11, 'Spin');

ALTER TABLE `activities` ADD UNIQUE(`activity_type`);
ALTER TABLE `transactions` CHANGE `tcat` `tcat` VARCHAR(255) NOT NULL DEFAULT '0';

ALTER TABLE transactions
ADD CONSTRAINT fk_tcat
FOREIGN KEY (tcat) REFERENCES activities(activity_type);


CREATE TABLE social_videos (
    id SERIAL PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    price DECIMAL(5, 2) NOT NULL
);

INSERT INTO social_videos (url, price) VALUES
('https://youtu.be/sOhvUDiDOws', 12.59),
('https://youtu.be/1mY3XSiqjxY', 6.41),
('https://youtu.be/1mY3XSiqjxY', 7.48),
('https://youtu.be/0XWzqUptsYU', 11.80),
('https://youtu.be/fUXdrl9ch_Q', 10.60),
('https://youtu.be/9MO1aY1xC80', 12.36),
('https://youtu.be/PpLPQVyxdxk', 5.55),
('https://youtu.be/ywjgf3xiwFM', 12.49);

ALTER TABLE social_videos
ADD categories VARCHAR(255) NOT NULL DEFAULT 'NONE';

UPDATE social_videos SET categories = 'Youtube';

ALTER TABLE `social_videos` CHANGE `id` `id` INT(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactions` CHANGE `ttype_id` `ttype_id` INT(255) NULL DEFAULT NULL;

ALTER TABLE transactions 
ADD CONSTRAINT fk_ttype_id
FOREIGN KEY (ttype_id) REFERENCES social_videos(id)

INSERT INTO social_videos (url, price, categories) VALUES
('https://vm.tiktok.com/ZMrp1jTNk', 7, 'TikTok'),
('https://vm.tiktok.com/ZMrp1BqKu', 9, 'TikTok'),
('https://vm.tiktok.com/ZMrp1YbyM', 11, 'TikTok'),
('https://vm.tiktok.com/ZMrp1mPTv', 6, 'TikTok'),
('https://vm.tiktok.com/ZMrgoWCNW', 12, 'TikTok'),
('https://vm.tiktok.com/ZMrgo3NbL', 8, 'TikTok');


ALTER TABLE social_videos
ADD COLUMN sdate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `users` CHANGE `emailed` `emailed` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '0 is for not approved 1 = rejected 2 = accepted';


-- updated code 


ALTER TABLE users
ADD COLUMN default_currency VARCHAR(255) DEFAULT 'USDT' NOT NULL;

ALTER TABLE users 
ADD CONSTRAINT fk_dcurrency
FOREIGN KEY (default_currency) REFERENCES affiliatefee(cid);

ALTER TABLE affiliatefee 
ADD CONSTRAINT fk_affid
FOREIGN KEY (cid) REFERENCES countrys(cid);

UPDATE users 
SET default_currency = 'USDT';

UPDATE users u 
JOIN affiliatefee e
ON e.cid = u.ucountryid
SET u.default_currency = u.ucountryid;

UPDATE users u
LEFT JOIN affiliatefee e 
ON e.cid = u.ucountryid 
SET u.ustatus = '1'
WHERE e.cid IS NULL;

UPDATE balances b
INNER JOIN users u 
ON b.buid = u.uid 
SET b.deposit = 0
WHERE u.ustatus = 2 

SELECT *
FROM users u
INNER JOIN balances b
ON b.buid = u.uid
LEFT JOIN affiliatefee e 
ON e.cid = u.ucountryid 
WHERE u.ucountryid NOT IN (SELECT cid FROM affiliatefee) LIMIT 500;


SELECT *
FROM users u
INNER JOIN balances b
ON b.buid = u.uid
LEFT JOIN affiliatefee e 
ON e.cid = u.default_currency 
WHERE u.ucountryid NOT IN (SELECT cid FROM affiliatefee) LIMIT 500;

--  NEW UPDATE




ALTER TABLE `payment_method` CHANGE `ptype` `ptype` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '0 = None \r\n1 = Automation\r\n2 = Links\r\n3 = Procedure';

