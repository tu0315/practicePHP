create table product (
    id int auto_increment primary key,
    name varchar(200) not null,
    price int not null
);

insert into product values(null, 'カップ麺', 200);
insert into product values(null, 'かつおのたたき', 400);
insert into product values(null, 'ジュース', 160);
insert into product values(null, 'ジャイアントコーン', 180);
insert into product values(null, 'おせんべい', 200);
insert into product values(null, 'コシヒカリ5kg', 5000);
insert into product values(null, '洗濯機', 100000);
insert into product values(null, 'エアコン', 70000);
insert into product values(null, '電子レンジ', 10000);
insert into product values(null, 'モニタースピーカー', 20000);