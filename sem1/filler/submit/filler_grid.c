/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   filler_grid.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/01/03 11:34:01 by mmacdona          #+#    #+#             */
/*   Updated: 2018/01/03 11:34:03 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "filler.h"

void	read_grid(char ***grid)
{
	char	*line;
	char	**split;
	int		grid_row;
	int		temp_int;
	int		ret;

	ret = get_next_line(0, &line);
	if (ft_strncmp(line, "Plateau", 7) == 0)
	{
		split = ft_strsplit(line, ' ');
		ret = get_next_line(0, &line);
		grid_row = ft_atoi(split[1]);
		split = (char **)malloc(sizeof(char *) * grid_row + 1);
		temp_int = 0;
		while (temp_int < grid_row && (ret = get_next_line(0, &line)) > 0)
		{
			split[temp_int] = ft_strdup(&line[4]);
			temp_int++;
		}
		split[temp_int] = NULL;
		*grid = split;
	}
}

void	read_piece(char ***piece)
{
	char	*line;
	char	**split;
	int		piece_row;
	int		temp_int;
	int		ret;

	ret = get_next_line(0, &line);
	if (ft_strncmp(line, "Piece", 5) == 0)
	{
		split = ft_strsplit(line, ' ');
		piece_row = ft_atoi(split[1]);
		split = (char **)malloc(sizeof(char *) * piece_row + 1);
		temp_int = 0;
		while (temp_int < piece_row && (ret = get_next_line(0, &line)) > 0)
		{
			split[temp_int] = ft_strdup(line);
			temp_int++;
		}
		split[temp_int] = NULL;
		*piece = split;
	}
}

int		x_offset(char **piece)
{
	int x;
	int y;

	x = 0;
	y = 0;
	while (piece[y] != NULL && piece[y][x] != '\0')
	{
		while (piece[y] != NULL)
		{
			if (piece[y][x] == '*')
				return (x);
			y++;
		}
		y = 0;
		x++;
	}
	return (0);
}

int		y_offset(char **piece)
{
	int x;
	int y;

	y = 0;
	while (piece[y] != NULL)
	{
		x = 0;
		while (piece[y][x] != '\0')
		{
			if (piece[y][x] == '*')
				return (y);
			x++;
		}
		y++;
	}
	return (0);
}

int		get_max(char **arr, char coord)
{
	int x;
	int y;

	y = 0;
	while (arr[y] != NULL)
		y++;
	x = 0;
	while (arr[0][x] != '\0')
		x++;
	if (coord == 'x')
		return (x);
	if (coord == 'y')
		return (y);
	return (-1);
}
