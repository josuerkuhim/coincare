-- CATEGORIA

CREATE TABLE public.categoria (
	id_categoria serial4 NOT NULL,
	id_tipo_categoria int4 NOT NULL,
	ds_categoria varchar(50) NULL,
	CONSTRAINT categoria_pkey PRIMARY KEY (id_categoria)
);


-- FK TIPO CATEGORIA

ALTER TABLE public.categoria ADD CONSTRAINT id_categoria_tipo_categoria FOREIGN KEY (id_tipo_categoria) REFERENCES public.tipo_categoria(id_tipocategoria);

------------------------------------------------------------------------------------------------

-- TIPO CATEGORIA

CREATE TABLE public.tipo_categoria (
	id_tipocategoria serial4 NOT NULL,
	nm_tipocategoria varchar(50) NOT NULL,
	CONSTRAINT tipo_categoria_pkey PRIMARY KEY (id_tipocategoria)
);

------------------------------------------------------------------------------------------------

-- USUARIO

CREATE TABLE public.usuario (
	id_usuario serial4 NOT NULL,
	nome varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	senha varchar(255) NOT NULL,
	cpf varchar(14) NOT NULL,
	telefone varchar(15) NOT NULL,
	CONSTRAINT usuario_cpf_key UNIQUE (cpf),
	CONSTRAINT usuario_email_key UNIQUE (email),
	CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario),
	CONSTRAINT usuario_telefone_key UNIQUE (telefone)
);

------------------------------------------------------------------------------------------------

-- TRANSAÇÃO

CREATE TABLE public.transacao (
	id_transacao bigserial NOT NULL,
	id_tipo_transacao int4 NOT NULL,
    id_dc_transacao int4 NOT NULL,
	dt_transacao date NOT NULL,
	vl_transacao numeric(10, 2) NOT NULL,
	id_usuario int4 NULL,
	CONSTRAINT transacao_pkey PRIMARY KEY (id_transacao)
);


-- FK ID USUARIO E CATEGORIA

ALTER TABLE public.transacao ADD CONSTRAINT fk_id_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario);
ALTER TABLE public.transacao ADD CONSTRAINT fk_id_dc_transacao FOREIGN KEY (id_dc_transacao) REFERENCES public.dc_transacao(id_dc_transacao);
ALTER TABLE public.transacao ADD CONSTRAINT transacao_id_tipo_transacao_fkey FOREIGN KEY (id_tipo_transacao) REFERENCES public.categoria(id_categoria); 

------------------------------------------------------------------------------------------------

-- TIPO TRANSAÇÃO

CREATE TABLE public.dc_transacao (
    id_dc_transacao serial4 NOT NULL,
    nm_dc_transacao varchar(50) NOT NULL,
    CONSTRAINT dc_transacao_pkey PRIMARY KEY (id_dc_transacao)
);

------------------------------------------------------------------------------------------------

-- SALDO ATUAL

CREATE OR REPLACE FUNCTION public.saldo_atual(p_usuario_id int, p_data_inicio date DEFAULT null, p_data_fim date DEFAULT null)
 RETURNS numeric(10, 2)
 LANGUAGE plpgsql
AS $function$
DECLARE 
    v_ganho decimal(10, 2) := 0;
    v_despesa decimal(10, 2) := 0;
BEGIN
    SELECT COALESCE(SUM(CASE WHEN c.id_tipo_categoria = 1 THEN t.vl_transacao ELSE 0 END), 0)
    INTO v_ganho
    FROM transacao t
    INNER JOIN categoria c ON t.id_tipo_transacao = c.id_categoria
    WHERE t.id_usuario = p_usuario_id
    AND (p_data_inicio IS NULL OR t.dt_transacao >= p_data_inicio)
    AND (p_data_fim IS NULL OR t.dt_transacao <= p_data_fim);

    SELECT COALESCE(SUM(CASE WHEN c.id_tipo_categoria = 2 THEN t.vl_transacao ELSE 0 END), 0)
    INTO v_despesa
    FROM transacao t
    INNER JOIN categoria c ON t.id_tipo_transacao = c.id_categoria
    WHERE t.id_usuario = p_usuario_id
    AND (p_data_inicio IS NULL OR t.dt_transacao >= p_data_inicio)
    AND (p_data_fim IS NULL OR t.dt_transacao <= p_data_fim);

    RETURN v_ganho - v_despesa;
END
$function$;
------------------------------------------------------------------------------------------------

-- RELATÓRIO DESPESAS

WITH CTE AS (
  SELECT c.ds_categoria AS nome, t.vl_transacao AS valor
  FROM categoria c
  INNER JOIN transacao t ON c.id_categoria = t.id_tipo_transacao
  WHERE c.id_tipo_categoria = 2
)

SELECT nome, valor, ROUND((valor / total * 100)::numeric, 2) AS porcentagem
FROM CTE, (SELECT SUM(valor) AS total FROM CTE) AS sub
ORDER BY nome;

-- RELATÓRIO DE RENDA

WITH CTE AS (
  SELECT c.ds_categoria AS nome, t.vl_transacao AS valor
  FROM categoria c
  INNER JOIN transacao t ON c.id_categoria = t.id_tipo_transacao
  WHERE c.id_tipo_categoria = 1
)

SELECT nome, valor, ROUND((valor / total * 100)::numeric, 2) AS porcentagem
FROM CTE, (SELECT SUM(valor) AS total FROM CTE) AS sub
ORDER BY nome;

-- ADD CONSTRAINT transacao

ALTER TABLE public.transacao
ADD COLUMN id_dc_transacao int4 NOT NULL;

-- Adicionando a Chave Estrangeira
ALTER TABLE public.transacao
ADD CONSTRAINT fk_id_dc_transacao FOREIGN KEY (id_dc_transacao) REFERENCES public.dc_transacao(id_dc_transacao);

-- Populando a Tabela dc_transacao
INSERT INTO public.dc_transacao (nm_dc_transacao) VALUES ('Débito'), ('Crédito');
