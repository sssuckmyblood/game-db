SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

-- Создаем БД
-- Имя: automobile; Тип: DATABASE; Схема: -; Владелец: postgres
--

CREATE DATABASE automobile WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Russian_Russia.1251';


ALTER DATABASE automobile OWNER TO postgres;

\connect automobile

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

-- Создаем таблицу автомобилей
-- Имя: automobile; Тип: TABLE; Схема: public; Владелец: postgres
--

CREATE TABLE public.automobile (
    id_car integer NOT NULL,
    brand character varying(256),
    model character varying(256),
    year integer,
    complectation character varying(256),
    engine_volume numeric,
    engine_type character varying(256),
    engine_power numeric,
    transmission character varying(256),
    carcase character varying(256),
    color character varying(256)
);


ALTER TABLE public.automobile OWNER TO postgres;

-- Последовательность дл таблицы автомобилей
-- Name: automobile_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.automobile_id_seq
    START WITH 1
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.automobile_id_seq OWNER TO postgres;

--
-- Name: automobile_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.automobile_id_seq OWNED BY public.automobile.id_car;


-- Создаем таблицу владельцев
-- Имя: owners; Тип: TABLE; Схема: public; Владелец: postgres
--

CREATE TABLE public.owners (
    id integer NOT NULL,
    id_car integer,
    fio character varying(256),
    city character varying(256),
    phone_number character varying(256)
);


ALTER TABLE public.owners OWNER TO postgres;

-- Последовательность для таблицы владельцев
-- Name: clients_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.clients_id_seq
    START WITH 1
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.clients_id_seq OWNER TO postgres;

--
-- Name: clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.clients_id_seq OWNED BY public.owners.id;


--
-- Name: automobile id_car; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.automobile ALTER COLUMN id_car SET DEFAULT nextval('public.automobile_id_seq'::regclass);


--
-- Name: owners id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.owners ALTER COLUMN id SET DEFAULT nextval('public.clients_id_seq'::regclass);


--
-- Name: automobile automobile_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.automobile
    ADD CONSTRAINT automobile_pk PRIMARY KEY (id_car);


--
-- Name: owners clients_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.owners
    ADD CONSTRAINT clients_pk PRIMARY KEY (id);


-- Задаем индекс уникальности для автомобилей
-- Имя: automobile_brand_model_complectation_uindex; Тип: INDEX; Схема: public; Владелец: postgres
--

CREATE UNIQUE INDEX automobile_brand_model_complectation_uindex ON public.automobile USING btree (brand, model, year, complectation, engine_volume, engine_type, engine_power, transmission, color);


--
-- Name: clients_uni; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX clients_uni ON public.owners USING btree (id_car, fio, city, phone_number);


-- Здаваем вторичеый ключ для таблицы владельцев
-- Имя: owners clients_automobile_id_car_fk; Тип: FK CONSTRAINT; Схема: public; Владелец: postgres
--

ALTER TABLE ONLY public.owners
    ADD CONSTRAINT clients_automobile_id_car_fk FOREIGN KEY (id_car) REFERENCES public.automobile(id_car) ON UPDATE CASCADE ON DELETE CASCADE;




