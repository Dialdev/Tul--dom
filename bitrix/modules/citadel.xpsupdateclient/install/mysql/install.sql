create table if not exists b_citadel_xpsupdateclient_client
(
  ID int not null auto_increment
,  ACTIVE char(1) not null default 'Y'
,  SERVER_KEY varchar(255) not null
,  SERVER_URL varchar(255) not null
,  DESCRIPTION text null
,  DATE_CREATE datetime not null
,  DATE_UPDATE datetime not null
,  CREATED_BY int null
,  UPDATED_BY int null
,  DATE_LAST_SYNC datetime null
,  SERVER_IBLOCK_TYPE text null
,  SERVER_IBLOCK_ID int null
,  SERVER_IBLOCK_KEY_ID text null
,  CLIENT_IBLOCK_TYPE text null
,  CLIENT_IBLOCK_ID int null
,  CLIENT_IBLOCK_KEY_ID text null
,  PROPERTIES_JSON text null
,  primary key (ID)
,  unique IX_KEY(SERVER_KEY)
,  index IX_DATE_CREATE(DATE_CREATE)
,  index IX_DATE_UPDATE(DATE_UPDATE)
);