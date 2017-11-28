/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/08/10 17:55:11 by mmacdona          #+#    #+#             */
/*   Updated: 2017/08/11 15:56:00 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdio.h>

int		ft_strsearch(const char *str, char c);

int main(int argc, char **argv)
{
	printf("%i\n", ft_strsearch(argv[1], '\n'));
	return (0);
}
