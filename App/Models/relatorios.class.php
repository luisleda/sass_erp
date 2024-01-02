<?php


/**
 * 
 */
require_once 'connect.php';

class Relatorio extends Connect
{

	public function qtdeItensEstoqueTotal($perm)
	{
		if ($perm == 1) {

			$query = "SELECT SUM(`QuantItens`) AS QuantItens , SUM(`QuantItensVend`) AS QuantItensVend FROM `itens`";

			$result = mysqli_query($this->SQL, $query);

			if ($row = mysqli_fetch_assoc($result)) {

				$qi = $row['QuantItens'];
				$qiv = $row['QuantItensVend'];
				$r = $qi - $qiv;
				return $r;
			}
		}
	}

	public function qtdeItensEstoque($perm, $status = null, $idProduto = null)
	{
		if ($perm == 1) {

			if ($idProduto != null) {
				$AND = "AND `Produto_CodRefProduto` = '$idProduto' AND `Ativo` = '$status'";
			} elseif ($status != null) {
				$AND = "AND `Ativo` = '$status'";
			} else {
				$AND = "";
			}


			$query = "SELECT `Produto_CodRefProduto`, `NomeProduto`, SUM(`QuantItens`) AS QuantItens , SUM(`QuantItensVend`) AS QuantItensVend FROM `itens`, `produtos`
				WHERE `Produto_CodRefProduto` = `CodRefProduto`
				$AND
				GROUP BY `Produto_CodRefProduto`";

			$result = mysqli_query($this->SQL, $query);

			while ($row[] = mysqli_fetch_assoc($result));
			return json_encode($row);
		}
	}

	public function selectCliente($perm)
	{
		if ($perm == 1) {

			$query = "SELECT `idCliente`,`NomeCliente` FROM `cliente`";
			$result = mysqli_query($this->SQL, $query);
			while ($row[] = mysqli_fetch_assoc($result));
			return json_encode($row);
		}
	}

	public function selectProduto($perm, $status = null)
	{
		if ($perm == 1) {

			if ($status != null) {
				$where = "WHERE `Ativo` = '$status'";
			} else {
				$where = "";
			}

			$query = "SELECT `CodRefProduto`,`NomeProduto` FROM `produtos` $where";
			$result = mysqli_query($this->SQL, $query);
			while ($row[] = mysqli_fetch_assoc($result));

			return json_encode($row);
		}
	}

	public function vendascliente($perm, $idProduto = null, $idCliente = null)
	{
		if ($perm == 1) {
			if ($idProduto != null && $idCliente != null) {
				$AND = "AND `Produto_CodRefProduto` = '$idProduto' AND `idCliente` = '$idCliente'";
			} elseif ($idProduto != null) {
				$AND = "AND `Produto_CodRefProduto` = '$idProduto'";
			} elseif ($idCliente != null) {
				$AND = "AND `idCliente` = '$idCliente'";
			} else {
				$AND = "";
			}
			$query = "SELECT * FROM vendas,cliente, itens, produtos WHERE cliente_idCliente = idCliente AND idItem = iditens AND Produto_CodRefProduto = CodRefProduto $AND ORDER BY idVendas DESC";
			$result = mysqli_query($this->SQL, $query);
			while ($row[] = mysqli_fetch_assoc($result));

			return json_encode($row);
		}
	}
}
