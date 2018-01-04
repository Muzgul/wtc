/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   filler.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/01/03 11:18:01 by mmacdona          #+#    #+#             */
/*   Updated: 2018/01/03 11:18:06 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "filler.h"

double	g_e[4][2] = {{0, 0.5}, {0.5, 1}, {1, 0.5}, {0.5, 0}};

int		main(void)
{
	char	**grid;
	char	**piece;
	int		step;
	char	player;

	step = 1;
	player = get_player();
	while (1 == 1)
	{
		read_grid(&grid);
		read_piece(&piece);
		if ((step = make_move(grid, piece, step, player)) == -1)
			print_move(0, 0);
	}
	return (2);
}

int		make_move(char **grid, char **piece, int step, int player)
{
	int temp;
	int new_step;

	new_step = -1;
	temp = move_step(grid, piece, step, player);
	if (temp < 3)
		new_step = step + 1;
	if (temp == -1)
		return (temp);
	if (new_step != -1)
		step = new_step;
	return (step);
}

int		move_step(char **grid, char **piece, int step, int player)
{
	int		i;
	int		g_y;
	int		g_x;
	int		*pt;

	g_y = get_max(grid, 'y');
	g_x = get_max(grid, 'x');
	if (step == 1)
		pt = get_coord((g_y / 2), (g_x / 2));
	if (step == 2)
	{
		i = best_edge(grid, (player - '0') - 1);
		pt = get_coord(((g_y - 1) * g_e[i][0]), ((g_x - 1) * g_e[i][1]));
	}
	if (step == 3)
	{
		i = best_edge(grid, 2 - (player - '0'));
		pt = get_coord(((g_y - 1) * g_e[i][0]), ((g_x - 1) * g_e[i][1]));
	}
	if (step > 3)
		pt = get_coord(rand() % (g_y - 1), rand() % (g_x - 1));
	i = build_to(grid, piece, player, pt);
	return (i);
}

int		build_to(char **grid, char **piece, int player, int *dest)
{
	int x;
	int y;
	int *point;

	y = 0;
	point = NULL;
	while (grid[y] != NULL)
	{
		x = 0;
		while (grid[y][x] != '\0')
		{
			if (valid_placement(grid, piece, get_coord(y, x), player) == 1)
			{
				if (distance_compare(piece, point, get_coord(y, x), dest) > 0)
					point = get_coord(y, x);
			}
			x++;
		}
		y++;
	}
	if (point == NULL)
		return (-1);
	print_move(point[0] - y_offset(piece), point[1] - x_offset(piece));
	return (distance_check(piece, point[0] - y_offset(piece),
							point[1] - x_offset(piece), dest));
}
